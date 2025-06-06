@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<div class="w-full sm:w-96">
    <flux:input name="abbreviation" label="Abbreviation" value="{{ old('abbreviation', $product->abbreviation) }}"
        :disabled="$readonly" :readonly="$mode == 'edit'"/>
</div>

<flux:input name="name" label="Name" value="{{ old('name', $product->name) }}" :disabled="$readonly" />

<x-field.image
    name="photo"
    label="Photo"
    width="md"
    readonly
    deleteTitle="Delete Photo"
    :deleteAllow="true"
    :imageUrl="$products->photoFullUrl"
    />
