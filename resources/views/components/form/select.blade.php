@props([
'label' => false, 'name', 'value' => '', 'parents'
])

<div class="form-group">

    <x-form.label :name="$name"> {{ $label }} </x-form.label>

    <select name="{{$name}}" id="{{$name}}" {{ $attributes->class(['form-control', 'is-invalid'=>
        $errors->has($name)])}}>
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