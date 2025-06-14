@props([
    'name',
    'label',
    'readonly' => false,
    'required' => false,
    'rows' => 4,
    'width' => 'md',
])

@php
    $widthClass = match($width) {
        'full' => 'w-full',
        'xs' => 'w-20',
        'sm' => 'w-32',
        'md' => 'w-64',
        'lg' => 'w-96',
        'xl' => 'w-[48rem]',
        default => 'w-64',
    };

    $borderClass = $errors->has($name)
        ? 'border-red-500 dark:border-red-500'
        : 'border-gray-300 dark:border-gray-700';
@endphp

<div {{ $attributes->merge(['class' => $widthClass]) }}>
    <label for="id_{{ $name }}" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
        {{ $label }}
    </label>
    <textarea
        id="id_{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        class="mt-1 block w-full rounded-md border {{ $borderClass }}
               bg-white dark:bg-gray-900 text-black dark:text-gray-50
               focus:border-indigo-500 dark:focus:border-indigo-400
               focus:ring-indigo-500 dark:focus:ring-indigo-400
               disabled:opacity-100 disabled:select-none
               shadow-sm resize-vertical"
        @required($required)
        @disabled($readonly)
    >{{ old($name, $slot) }}</textarea>
    @error($name)
        <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
    @enderror
</div>
