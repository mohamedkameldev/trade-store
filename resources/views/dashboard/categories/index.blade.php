@extends('layouts.dashboard')

@section('title', 'Categories')


@section('breadcrumb')
@parent {{-- to inheret parent section in addition to this section (if you don't write it, this will override parent's
section--}}
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">@yield('title')</a></li>
@endsection


@section('button')
<a href="{{ route('dashboard.categories.create') }}" class="btn btn-small btn-primary">New Category</a>
@endsection


@section('content')

@session('created')
<div class="alert alert-success" role="alert" style=" text-align: center">
    {{ session('created') }}
</div>
@endsession

@session('updated')
<div class="alert alert-info" role="alert" style=" text-align: center">
    {{ session('updated') }}
</div>
@endsession

@session('deleted')
<div class="alert alert-danger" role="alert" style=" text-align: center">
    {{ session('deleted') }}
</div>
@endsession

<table class="table table-bordered" style=" text-align: center; background-color: white">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Discription</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Created at</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>
                @if(is_null($category->image))
                <img src="{{asset('dist\img\placeholder.png')}}" alt="image" width="100" height="auto">
                @else
                <img src="{{asset('storage/' . $category->image)}}" alt="image" width="100" height="auto">
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
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                    class="btn btn-small btn-warning mr-2">Edit</a>
                <form action="{{ route('dashboard.categories.destroy', $category->id) }} }}" method="post"
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
                    There are no Categories yet, <a href="{{ route('dashboard.categories.create') }}">Add a new
                        Category</a>
                </div>
            </td>
        </tr>
        @endforelse

    </tbody>
</table>
@endsection