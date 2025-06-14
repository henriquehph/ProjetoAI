@php
    // Map width (e.g., 'md') to CSS classes (example using Tailwind or Bootstrap)
    $widthClasses = [
        'sm' => 'w-32',
        'md' => 'w-48',
        'lg' => 'w-64',
    ];
    $widthClass = $widthClasses[$width] ?? $widthClasses['md'];
@endphp

<div class="photo-upload-component">
    <label for="{{ $name }}" class="block font-semibold mb-1">{{ $label }}</label>

    @if($imageUrl)
        <div class="mb-2">
            <img src="{{ $imageUrl }}" alt="{{ $label }}" class="{{ $widthClass }} object-cover rounded" />
        </div>
    @endif

    @if(!$readonly)
        <input type="file" name="{{ $name }}" id="{{ $name }}" accept="image/*" class="block mb-2" />

        @if($deleteAllow && $imageUrl)
            <x-field.check-box name="delete_photo" :value="false" :label="$deleteTitle" width="md" :readonly="$readonly" />
        @endif
    @endif
</div>
