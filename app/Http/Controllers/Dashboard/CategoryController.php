<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::all();
        return view('dashboard.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        Category::create($request->all());

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
        $category->fill($request->all());
        $category->save();

        return to_route('dashboard.categories.index')->with('updated', 'category has been updated successfully !!');
    }

    public function destroy(string $id)
    {
        // 2 queries on the DB
        // $category = Category::findOrFail($id);
        // $category->delete();

        // Category::where('id', '=', (int)$id)->delete();
        Category::where('id', (int)$id)->delete();

        // Category::destroy($id);    // is a shourtcut for the previous one (find and delete in a single querey)

        return back()->with('deleted', 'category has been deleted successfully !!');
    }
}
