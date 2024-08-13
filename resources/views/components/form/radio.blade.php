@props([
'label' => false, 'status' => '', 'name', 'values'
])

<div class="form-group">

    <x-form.label> {{ $label }} </x-form.label>

    <div class="form-check">

        @foreach ($values as $value)
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="{{ $value }}" name="{{ $name }}" value="{{ $value }}"
                @class(['custom-control-input', 'is-invalid'=> $errors->has($name) ])
            @checked(old($name, $status) == $value ) >
            <label class="custom-control-label" for="{{ $value }}">{{ $value }}</label>
        </div>
        @endforeach

        @error($name)
        <small class="text-danger"> {{ $message }} </small>
        @enderror
    </div>
</div>