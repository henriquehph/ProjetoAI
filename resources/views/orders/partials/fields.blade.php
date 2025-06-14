@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp


<div class="flex flex-wrap gap-6 items-start">
    <div>
        <x-field.input name="id" label="ID" :readonly="true" value="{{ old('id', $order->id) }}" />

        <x-field.input name="member_id" label="Member ID" :readonly="true" value="{{ old('member_id', $order->member_id) }}" />

        <x-field.input name="nif" label="Nif" :readonly="true" value="{{ old('nif', $order->nif) }}" />

        <x-field.input name="date" label="Date" :readonly="true" value="{{ old('date', $order->date) }}" />

        <x-field.input name="total_items" label="Total Items" :readonly="true" value="{{ old('total_items', $order->total_items) }}" />

        <x-field.input name="shipping_cost" label="Shipping Cost" :readonly="true" value="{{ old('shipping_cost', $order->shipping_cost) }}" />

        <x-field.input name="total" label="Total" :readonly="true" value="{{ old('total', $order->total) }}" />

        <x-field.input name="delivery_address" label="Delivery Address" :readonly="true" value="{{ old('delivery_address', $order->delivery_address) }}" />
    </div>

</div>

