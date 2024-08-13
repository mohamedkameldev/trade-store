@props([
'lable' => false, 'status' => '', 'name', 'values'
])

<div class="form-group">

    @if ($lable)
    <label for="parent">{{ $lable }}</label>
    @endif

    <div class="form-check">

        @foreach ($values as $value)
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="{{ $value }}" name="{{ $name }}" value="{{ $value }}"
                @class(['custom-control-input', 'is-invalid'=> $errors->has($name) ])
            @checked(old($name, $status) == $value ) >
            <label class="custom-control-label" for="{{ $value }}">Active</label>
        </div>
        @endforeach

        @error($name)
        <small class="text-danger"> {{ $message }} </small>
        @enderror
    </div>
</div>