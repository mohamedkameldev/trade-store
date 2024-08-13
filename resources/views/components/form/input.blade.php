@props([
'type' => 'text', 'name', 'value' => '', 'label' => false
])

<div class="form-group">

    <x-form.label :name="$name"> {{ $label }} </x-form.label>

    <input {{ $attributes->class(['form-control', 'is-invalid'=> $errors->has($name)]) }}
    type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value )}}" id="{{ $name }}"
    >

    @error($name)
    <div class="invalid-feedback"> {{$message}} </div>
    @enderror
</div>