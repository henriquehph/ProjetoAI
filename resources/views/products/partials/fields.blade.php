@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp


<div class="flex flex-wrap gap-6 items-start">
    <div>

        <x-field.input name="id" label="ID" :readonly="true" value="{{ old('id', $product->id) }}" />

        <x-field.input name="category_name" label="Category" :readonly="$readonly"
            value="{{ $product->category ? $product->category->name : null}}" />
        @error('category_id')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <x-field.input name="name" label="Name" :readonly="$readonly" value="{{ old('name', $product->name) }}" />
        @error('name')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="price" label="Price (€)" type="number" step="0.01" min="0" :readonly="$readonly"
            value="{{ old('price', $product->price) }}" />
        @error('price')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="stock" label="Stock" type="number" min="0" :readonly="$readonly"
            value="{{ old('stock', $product->stock) }}" />
        @error('stock')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.text-area name="description" label="Description"
            :readonly="$readonly">{{ old('description', $product->description) }}</x-field.text-area>
        @error('description')
            <div class="text-red-500">{{ $message }}</div>
        @enderror


        <x-field.input name="discount_min_qty" label="Discount Min Quantity" type="number" min="0" :readonly="$readonly"
            value="{{ old('discount_min_qty', $readonly ? ($product->discount_min_qty ?? 0) : $product->discount_min_qty) }}" />
        @error('discount_min_qty')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="discount" label="Discount (€)" type="number" step="0.01" min="0" :readonly="$readonly"
            value="{{ old('discount', $readonly ? ($product->discount ?? 0) : $product->discount) }}"
        />
        @error('discount')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="stock_lower_limit" label="Stock Lower Limit" type="number" min="0" :readonly="$readonly"
            value="{{ old('stock_lower_limit', $product->stock_lower_limit) }}" />
        @error('stock_lower_limit')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="stock_upper_limit" label="Stock Upper Limit" type="number" min="0" :readonly="$readonly"
            value="{{ old('stock_upper_limit', $product->stock_upper_limit) }}" />
        @error('stock_upper_limit')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

    </div>

    <div>
        <x-photo-upload name="photo" label="Photo" width="md" readonly deleteTitle="Delete Photo"
            :deleteAllow="true" :imageUrl="$product->photoFullUrl" />
    </div>

</div>

