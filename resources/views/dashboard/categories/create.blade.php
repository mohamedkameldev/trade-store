@extends('layouts.dashboard')

@section('title', 'Create Category')


@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">Categories</a></li>
<li class="breadcrumb-item active"><a href="{{ route('categories.create') }}">@yield('title')</a></li>
@endsection


@section('content')
<form method="post" action="{{ route('categories.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="2" name="description"></textarea>
    </div>

    <div class="form-group">
        <label for="parent">Category Parent</label>
        <select name="parent_id" class="custom-select">
            <option selected value="">Primary Category</option>
            @foreach ($parents as $parent)
            <option value="{{$parent->id}}">{{$parent->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="parent">Image</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="image" id="image">
            <label class="custom-file-label" for="image">Choose file</label>
        </div>
    </div>

    <div class="form-group">
        <label for="parent">Status</label>
        <div class="form-check">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="active" name="status" class="custom-control-input" value="active" checked>
                <label class="custom-control-label" for="active">Active</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="archived" name="status" class="custom-control-input" value="archived">
                <label class="custom-control-label" for="archived">Archived</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection