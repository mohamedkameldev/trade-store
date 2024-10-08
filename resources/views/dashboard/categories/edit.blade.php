@extends('layouts.dashboard')

@section('title', 'Edit Category')


@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.create') }}">@yield('title')</a></li>
@endsection


@section('content')
<form method="post" action="{{ route('dashboard.categories.update', $category->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('dashboard.categories._form', [
    'button_label' => 'Update'
    ])
</form>
@endsection