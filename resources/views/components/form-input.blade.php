@props(['name', 'type' => 'text', 'placeholder' => '', 'value' => ''])

<div class="mb-4">
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="border rounded px-3 py-2 w-full @error($name) border-red-600 @enderror"
    >
    @error($name)
        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
    @enderror
</div>