@props([
'lable' => false, 'name', 'value' => ''
])

@if ($lable)
<label for="description">{{ $lable }}</label>
@endif

<textarea name="{{ $name }}" @class(['form-control', 'is-invalid'=> $errors->has($name) ]) 
    id="{{ $name }}" rows="2">{{ old($name, $value )}}</textarea>
@error($name)
<div class="invalid-feedback"> {{ $message }} </div>
@enderror