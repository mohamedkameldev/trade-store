@props([
'label' => false, 'name', 'value' => ''
])

<div class="form-group">

    <x-form.label :name="$name"> {{ $label }} </x-form.label>

    <textarea name="{{ $name }}" @class(['form-control', 'is-invalid'=> $errors->has($name) ]) 
    id="{{ $name }}" rows="2">{{ old($name, $value )}}</textarea>
    @error($name)
    <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>