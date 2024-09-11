@extends('layouts.dashboard')

@section('title', 'Products')


@section('breadcrumb')
@parent {{-- to inheret parent section in addition to this section (if you don't write it, this will override parent's
section--}}
<li class="breadcrumb-item active"><a href="{{ route('dashboard.products.index') }}">@yield('title')</a></li>
@endsection


@section('button')
<a href="{{ route('dashboard.products.create') }}" class="btn btn-small btn-outline-primary mr-2">New Product</a>
{{-- <a href="{{ route('dashboard.products.trash') }}" class="btn btn-small btn-outline-danger">Trash</a> --}}
@endsection


@section('content')

<x-alert />

{{-- @include('dashboard.products._search-form') --}}

<table class="table table-bordered" style=" text-align: center; background-color: white">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Discription</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Featured</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($products as $product)
        <tr>
            <td>
                @if($product->image)
                <img src="{{asset('storage/' . $product->image)}}" alt="image" width="100" height="auto">
                @else
                <img src="{{asset('dist\img\placeholder.png')}}" alt="image" width="100" height="auto">
                @endif

            </td>
            <td>{{ $product->name }}</td>
            <td>{{ Str::substrReplace($product->description, '....', 25) }}</td>
            <td>{{ $product->category->name }}</td>
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
                {!! $product->featured ? '<div class="bg-success text-white">featured</div>' : '' !!}
            </td>
            <td>
                <a href="{{ route('dashboard.products.edit', $product->id) }}"
                    class="btn btn-small btn-warning mr-2">Edit</a>
                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post"
                    style="display:inline">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-small btn-danger">
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <div class="alert alert-secondary" role="alert">
                    There are no Products yet, <a href="{{ route('dashboard.products.create') }}">Add a new
                        Product</a>
                </div>
            </td>
        </tr>
        @endforelse

    </tbody>
</table>

{{ $products->withQueryString()->links() }}

{{-- to use a custom pagination file only in this page --}}
{{-- {{ $products->withQueryString()->links('pagination.custom') }} --}}

{{-- to send query strings while moving forward into pages --}}
{{-- {{ $products->withQueryString()->appends(['on_tap' => 'click'])->links() }} --}}
@endsection