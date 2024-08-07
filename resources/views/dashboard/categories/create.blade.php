@extends('layouts.dashboard')

@section('title', 'Create Category')


@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.create') }}">@yield('title')</a></li>
@endsection


@section('content')
<form method="post" action="{{ route('dashboard.categories.store') }}">
    @csrf

    @include('dashboard.categories._form')
</form>
@endsection