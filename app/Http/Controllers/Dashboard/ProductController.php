<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // local scope: you define it and explicitly using it when you need.
        // gloabl scope: you define it, and it will be used automatically in all select queries.

        // $products = Product::active()->paginate(5);
        // $products = Product::paginate(5);   // lazy loading (works but n+1 problem)
        $products = Product::with(['category', 'store'])->paginate(10);   // eager loading

        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        $product = new Product();

        return view('dashboard.products.create', compact('categories', 'product'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->except(['tags', '_token']);

        $data['store_id'] = 1;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $data['image'] = upload($file);
        }
        $product = Product::create($data);

        $user_tags = explode(',', $request->tags);
        $tag_ids = [];

        foreach ($user_tags as $user_tag) {
            $slug = Str::slug($user_tag);
            $tag = Tag::whereSlug($slug)->first();

            if (!$tag) {
                $tag = Tag::create([
                'name' => $user_tag,
                'slug' => $slug
            ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);
        return to_route('dashboard.products.index')->with('created', 'product has been created successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $tags = implode(',', $product->tags->pluck('name')->toArray());

        return view('dashboard.products.edit', compact('categories', 'product', 'tags'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->except(['tags', '_token']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $data['image'] = upload($file);
        }
        $product->update($data);

        $user_tags = explode(',', $request->tags);
        $db_tags = Tag::all();
        $tag_ids = [];

        foreach ($user_tags as $user_tag) {
            $slug = Str::slug($user_tag);
            $tag = $db_tags->where('slug', $slug)->first();

            if (!$tag) {
                $tag = Tag::create([
                'name' => $user_tag,
                'slug' => $slug
            ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return to_route('dashboard.products.index')->with('updated', 'product has been updated successfully');
    }

    public function destroy(string $id)
    {
        Product::destroy($id);
        return to_route('dashboard.products.index')->with('deleted', 'product has been deleted successfully');
    }
}
