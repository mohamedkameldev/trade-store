@extends('layouts.dashboard')

@section('title', 'Trash Categories')


@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.trash') }}">@yield('title')</a></li>
@endsection


@section('button')
<a href="{{ route('dashboard.categories.index') }}" class="btn btn-small btn-outline-primary">Categories</a>
@endsection


@section('content')

<x-alert />

@include('dashboard.categories._search-form')

<table class="table table-bordered" style=" text-align: center; background-color: white">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Discription</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Deleted at</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($trashedCategories as $category)
        <tr>
            <td>
                @if($category->image)
                <img src="{{asset('storage/' . $category->image)}}" alt="image" width="100" height="auto">
                @else
                <img src="{{asset('dist\img\placeholder.png')}}" alt="image" width="100" height="auto">
                @endif

            </td>
            <td>{{ $category->name }}</td>
            <td>{{ Str::substrReplace($category->description, '....', 25) }}</td>
            <td>{{ !is_null($category->parent_id)
                ? DB::table('categories')->where('id', $category->parent_id)->first()->name
                : '' }}
            </td>
            <td>
                @if ($category->status == 'active')
                <p class="text-success"> Active </p>
                @else
                <p class="text-black-50"> Archived </p>
                @endif
            </td>
            <td>{{ $category->deleted_at }}</td>
            <td>
                <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post"
                    style="display:inline">
                    @csrf
                    @method('put')
                    <input type="submit" value="Restore" class="btn btn-small btn-dark">
                </form>
                <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post"
                    style="display:inline">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-small btn-danger">
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">
                <div class="alert alert-secondary" role="alert">
                    There are no Categories at your Trash
                </div>
            </td>
        </tr>
        @endforelse

    </tbody>
</table>


@endsection