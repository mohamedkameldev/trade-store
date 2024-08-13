@props([
'name' => ''
])

@if ($slot)
<label for="{{ $name }}">{{ $slot }}</label>
@endif