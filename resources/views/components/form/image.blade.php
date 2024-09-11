@props([
'label' => false, 'name', 'image' => null
])


<div class="form-group">
    <div class="d-flex image-label-container">

        <x-form.label :name="$name"> {{ $label }} </x-form.label>

        @if ($image)
        <img class="ml-4 mb-2" src="{{asset('storage/' . $image)}}" alt="image" width="100" height="auto">
        @endif
    </div>

    <div class="custom-file">
        <input type="file" @class(['custom-file-input', 'is-invalid'=> $errors->has($name) ])
        name="{{ $name }}" id="{{ $name }}" accept="image/*">

        <label class="custom-file-label" for="{{ $name }}"> {{old($name, $image) ?? 'Choose file' }}
        </label>

        @error($name)
        <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
    </div>
</div>