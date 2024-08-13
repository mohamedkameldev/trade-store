@props([
'type' => 'text', 'name', 'value' => '', 'lable' => false
])

<div class="form-group">
    @if ($lable)
    <label for="{{ $name }}">{{ $lable }}</label>
    @endif

    <input {{ $attributes->class(['form-control', 'is-invalid'=> $errors->has($name)]) }}
    type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value )}}" id="{{ $name }}"
    >

    @error($name)
    <div class="invalid-feedback"> {{$message}} </div>
    @enderror
</div>