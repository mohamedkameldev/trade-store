@extends('layouts.dashboard')

@section('title', 'Edit Product')


@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
<li class="breadcrumb-item active"><a href="{{ route('dashboard.products.create') }}">@yield('title')</a></li>
@endsection

@section('button')
<a href="{{ route('dashboard.products.create') }}" class="btn btn-small btn-outline-primary mr-2">New Product</a>
@endsection

@section('content')
<form method="post" action="{{ route('dashboard.products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('dashboard.products._form')
</form>
@endsection