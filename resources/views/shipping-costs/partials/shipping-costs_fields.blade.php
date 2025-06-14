@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<div class="flex flex-wrap gap-6 items-start">

    <div>
        <x-field.input name="id" label="ID" :readonly="true" value="{{ old('id', $shippingCost->id) }}" />
        @error('id')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <x-field.input name="min_value_threshold" label="Minimum Value Threshold" :readonly="$readonly"
            value="{{ old('min_value_threshold', $shippingCost->min_value_threshold ?? '') }}" />
        @error('min_value_threshold')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="max_value_threshold" label="Maximum Value Threshold" :readonly="$readonly"
            value="{{ old('max_value_threshold', $shippingCost->max_value_threshold ?? '') }}" />
        @error('max_value_threshold')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="shipping_cost" label="shipping_cost" :readonly="$readonly"
            value="{{ old('shipping_cost', $shippingCost->shipping_cost) }}" />
        @error('shipping_cost')
            <div class="text-red-500">{{ $message }}</div>
        @enderror


    </div>