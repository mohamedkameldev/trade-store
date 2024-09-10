@extends('layouts.dashboard')

@section('title', 'Edit Profile')


@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.create') }}">@yield('title')</a></li>
@endsection


@section('content')

<x-alert />

<form method="post" action="{{ route('dashboard.profile.update') }}">
    @csrf
    @method('patch')

    <div class="form-row">
        <div class="col-md-6">
            <x-form.input label="First Name" type="text" name="first_name" :value="$profile->first_name" />
        </div>
        <div class="col-md-6">
            <x-form.input label="Last Name" type="text" name="last_name" :value="$profile->last_name" />
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <x-form.select-keys label="Country" name="country" :options="$countries" :value="$profile->country" />
        </div>
        <div class="col-md-6">
            <x-form.select-keys label="Locale" name="local" :options="$languages" :value="$profile->local" />
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-3">
            <x-form.input label="Street Address" type="text" name="street_address" :value="$profile->street_address" />
        </div>
        <div class="col-md-3">
            <x-form.input label="City" type="text" name="city" :value="$profile->city" />
        </div>
        <div class="col-md-3">
            <x-form.input label="State" type="text" name="state" :value="$profile->state" />
        </div>
        <div class="col-md-3">
            <x-form.input label="Postal Code" type="text" name="postal_code" :value="$profile->postal_code" />
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <x-form.input label="Date Of Birth" type="date" name="birthday" :value="$profile->birthday" />
        </div>
        <div class="col-md-6">
            <x-form.radio label="Gender" name="gender" :status="$profile->gender" :values="['male', 'female']" />
        </div>
    </div>

    <x-form.submit-button :buttonlabel="$profile->country ? 'Update' : 'Save' " />
</form>
@endsection