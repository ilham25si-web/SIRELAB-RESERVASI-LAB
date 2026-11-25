@props(['name', 'label', 'type' => 'text', 'value' => null])

<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
           value="{{ $type === 'password' ? '' : old($name, $value) }}">
    @error($name) <small>{{ $message }}</small> @enderror
</div>