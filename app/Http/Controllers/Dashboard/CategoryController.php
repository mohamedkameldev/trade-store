<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::simplePaginate(2); // simple view (by default 15)
        $categories = Category::paginate(5); // by default returns 15
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

        if($request->hasFile('image')) {
            $file = $request->file('image'); // UploadedFile Object
            $path = $this->upload($file);
            $data['image'] = $path;
        }

        Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('created', 'Category has been created successfully !!');
    }

    public function show(string $id)
    {
        //
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

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $this->upload($file);
            $data['image'] = $path;
        }

        $category->fill($data);
        $category->save();

        // after updating the category, we can delete the old image from the storage file
        // if($old_image && isset($data['image'])) {
        if($old_image && isset($data['image'])) {
            // Storage::delete($old_image);
            // Storage Facade deals with local disk by default - you need to specify the disk

            Storage::disk('public')->delete($old_image);
        }

        return to_route('dashboard.categories.index')->with('updated', 'category has been updated successfully !!');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $deleted = $category->delete();                             // 2 queries on the DB

        // Category::where('id', '=', (int)$id)->delete();          // 1 query on the DB
        // $deleted = Category::where('id', (int)$id)->delete();

        // Category::destroy($id);    // shourtcut for the previous one (find and delete in a single querey)

        if($deleted && $category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return back()->with('deleted', 'category has been deleted successfully !!');
    }

    protected function upload($file)
    {
        // dump($file->getSize());
        // dump($file->getFileInfo());
        // dump($file->getFilename());     // the current name in the temp folder
        // dump($file->getClientOriginalName());
        // dump($file->getClientOriginalExtension());
        // dump($file->getMimeType());
        // dd($file);

        // $path = $file->store('uploads'); // .env disk
        // $path = $file->store('uploads', 'local'); // local disk (storage/app)
        // $path = $file->store('uploads', 'public'); // public disk (storeag/app/public)
        // $path = $file->store('uploads', [
        //     'disk' => 'public'
        // ]);
        // store function make a random name for the file

        $file_name = now()->timestamp . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $file_name, 'public');

        return $path;
    }
}
