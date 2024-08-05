@extends('layouts.dashboard')

@section('title', 'Categories')


@section('breadcrumb')
@parent {{-- to inheret parent section in addition to this section (if you don't write it, this will override parent's
section--}}
<li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">@yield('title')</a></li>
@endsection


@section('button')
<a href="{{ route('categories.create') }}" class="btn btn-small btn-primary">New Category</a>
@endsection


@section('content')

@session('created')
<div class="alert alert-success" role="alert" style=" text-align: center">
    {{ session('created') }}
</div>
@endsession

<table class="table table-bordered" style=" text-align: center; background-color: white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created at</th>
            <th colspan="2">Actions</th>
            {{-- <th></th> --}}
        </tr>
    </thead>

    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->parent_id }}</td>
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('categories.edit', 1) }}" class="btn btn-small btn-warning mr-2">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }} }}" method="post" style="display:inline">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-small btn-danger">
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">
                <div class="alert alert-secondary" role="alert">
                    There are no Categories yet, <a href="{{ route('categories.create') }}">Add a new Category</a>
                </div>
            </td>
        </tr>
        @endforelse

    </tbody>
</table>
@endsection