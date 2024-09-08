@extends('layouts.dashboard')

@section('title', "Category - $category->name")


@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.show', $category->id) }}">@yield('title')</a>
</li>
@endsection


@section('content')

<div class="card mb-3 mx-5">
    <img class="card-img-top" src="{{ asset('storage/'. $category->image) }}" alt="Category Image" height="250">
    <div class="card-body">
        <h5 class="card-title">{{ $category->name }}</h5>
        <p class="card-text">{{ $category->description }} </p>
        <p class="card-text"><small class="text-muted">{{ $category->parent->name }}</small></p>
    </div>
</div>

<div class="text-center mt-5">
    <h4> Category Products </h4>
</div>

<table class="table table-bordered" style=" text-align: center; background-color: white">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Featured</th>
        </tr>
    </thead>

    <tbody>
        @php
        $category_products = $category->products()->with('store')->paginate(5);
        @endphp
        @forelse ($category_products as $product)
        <tr>
            <td>
                @if($product->image)
                <img src="{{asset('storage/' . $product->image)}}" alt="image" width="150" height="auto">
                @else
                <img src="{{asset('dist\img\placeholder.png')}}" alt="image" width="150" height="auto">
                @endif

            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->store->name }}</td>
            </td>
            <td>
                @if ($product->status == 'active')
                <p class="text-success"> Active </p>
                @elseif ($product->status == 'draft')
                <p class="text-info"> Draft </p>
                @elseif ($product->status == 'archived')
                <p class="text-black-50"> Archived </p>
                @else
                <p></p>
                @endif
            </td>
            <td>
                {!! $product->featured ? '<div class="p-3 bg-success text-white">featured</div>' : '' !!}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">
                <div class="alert alert-secondary" role="alert">
                    There are no Products yet, <a href="{{ route('dashboard.products.create') }}">Add a new Product</a>
                </div>
            </td>
        </tr>
        @endforelse

    </tbody>
</table>
{{$category_products->links()}}
@endsection