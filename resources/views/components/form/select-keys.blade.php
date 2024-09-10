@props([
'label' => false, 'name', 'value' => '', 'options' => [], 'default' => ''
])

<div class="form-group">

    <x-form.label :name="$name"> {{ $label }} </x-form.label>

    <select {{ $attributes->class(['form-control', 'form-select', 'is-invalid'=> $errors->has($name)]) }}
        name="{{ $name }}" id="{{ $name }}" >

        <option {{ old($name , $value ) ?? 'selected' }} value=""> {{ $default }} </option>
        @foreach ($options as $key => $option)
        <option value="{{$key}}" @selected(old($name , $value)==$key)>
            {{$option}}
        </option>
        @endforeach

    </select>

    @error($name)
    <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>