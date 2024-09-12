<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        // using local scope:
        // $categories = Category::active()->paginate();
        // $categories = Category::status('archived')->paginate();
        // $categories = Category::status('archived')->active()->dd();

        // $categories = Category::filter(['name' => request()->name, 'status' => request()->status ])->dd();
        $categories = Category::with('parent')                          // eager loading
                                // ->withCount(['children', 'products'])   // not an eager loading - we don't fetch the relation data
                                // ->withCount(['children as number_of_children', 'products'])   // to change the default name
                                ->withCount([
                                    'products',
                                    'children as number_of_children'
                                    // => function ($query) {
                                    //     $query->where('status', 'active');
                                    // }
                                    ])
                                ->filter(request()->query())
                                ->paginate(5);
        // by default: Global Scopes will put a condition (where `deleted_at` is_null)
        // ->withTrashed(): forcing laravel to retrive the deleted item.
        // ->onlyTrashed(): forcing laravel to retrive only the deleted items.

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    public function store(Request $request)
    {
        $validated_data =  $request->validate(Category::rules(), [
            'required' => ':attribute is required',     // for all attributes
            'max' => ':attribute can Not be more than 2 KB',
            'status.in' => 'values that allowed are: active and archived',
        ]);

        // dd($validated_data);  // no description (just the validated data - write description in the rules)

        // $request->merge([
        //     'slug' => Str::slug($request->post('name'))
        // ]);

        $data = $request->except('_token', 'image');

        if ($request->hasFile('image')) {
            $file = $request->file('image'); // UploadedFile Object
            // dd($file);
            $path = upload($file);
            $data['image'] = $path;
        }
        // dd($data);
        Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('created', 'Category has been created successfully !!');
    }

    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        $parents = Category::where('id', '<>', $category->id)
                            ->where(function ($query) use ($category) {
                                $query->where('parent_id', '<>', $category->id)
                                      ->orWhere('parent_id', null);
                            })->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(Category::rules($category->id));

        $old_image = $category->image;
        $data = $request->except('_token', '_method', 'image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = upload($file);
            $data['image'] = $path;
        }

        $category->fill($data);
        $category->save();

        // after updating the category, we can delete the old image from the storage file
        // if($old_image && isset($data['image'])) {
        if ($old_image && isset($data['image'])) {
            // Storage::delete($old_image);
            // Storage Facade deals with local disk by default - you need to specify the disk

            Storage::disk('public')->delete($old_image);
        }

        return to_route('dashboard.categories.index')->with('updated', 'category has been updated successfully !!');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();                             // 2 queries on the DB

        // Category::where('id', '=', (int)$id)->delete();          // 1 query on the DB
        // $deleted = Category::where('id', (int)$id)->delete();

        // Category::destroy($id);    // shourtcut for the previous one (find and delete in a single querey)

        return back()->with('deleted', 'category has been deleted successfully !!');
    }

    ##---------------------------------- Soft Delete methods
    public function trash()
    {
        $trashedCategories = Category::filter(request()->query())->onlyTrashed()->get();

        return view('dashboard.categories.trash', compact('trashedCategories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return to_route('dashboard.categories.trash')->with('restored', 'category has been restored successfully');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $deleted = $category->forceDelete();

        if ($deleted && $category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return to_route('dashboard.categories.trash')->with('forced', 'category has been permenantly deleted');
    }
}
