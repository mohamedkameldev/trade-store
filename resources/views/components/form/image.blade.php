@props([
'lable' => false, 'name', 'image'
])


<div class="form-group">
    <div class="d-flex image-label-container">

        @if ($lable)
        <label for="image">{{ $lable }}</label>
        @endif

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