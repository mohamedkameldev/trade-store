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

        return redirect()->route('categories.index')->with('created', 'Category has been created successfully !!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
