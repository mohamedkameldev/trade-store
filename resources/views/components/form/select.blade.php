@props([
'lable' => false, 'name', 'value' => '', 'parents'
])

<div class="form-group">

    @if ($lable)
    <label for="{{ $name }}">{{ $lable }}</label>
    @endif

    <select name="{{ $name }}" {{ $attributes->class(['form-control', 'is-invalid'=> $errors->has($name) ]) }}>
        <option {{ old($name , $value ) ?? 'selected' }} value="">Primary Category</option>
        @foreach ($parents as $parent)
        <option value="{{$parent->id}}" @selected(old($name , $value)==$parent->id)>
            {{$parent->name}} </option>
        @endforeach
    </select>
    @error($name)
    <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>