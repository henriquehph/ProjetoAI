@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<div class="flex flex-wrap gap-6 items-start">

    <div>
        <x-field.input name="name" label="Name" :readonly="$readonly" value="{{ old('name', $user->name) }}" />
        @error('name')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="email" label="Email" :readonly="$readonly" value="{{ old('email', $user->email) }}" />
        @error('email')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.select name="type" label="Type" width="md" :readonly="$readonly" value="{{ old('type', $user->type) }}"
            :options="[
        'pending_member' => 'Pending Activation',
        'board' => 'Board Member',
        'member' => 'Active Member',
        'employee' => 'Employee',
    ]" />


        <x-field.select name="blocked" label="Blocked" width="md" :readonly="$readonly"
            value="{{ old('blocked', $user->blocked) }}" :options="[
        '1' => 'Blocked',
        '0' => 'Not Blocked',
    ]" />


        <x-field.select name="gender" label="Gender" width="md" :readonly="$readonly"
            value="{{ old('gender', $user->gender) }}" :options="[
        'M' => 'Male',
        'F' => 'Female',
    ]" />


        <x-field.input name="nif" label="NIF" :readonly="$readonly" value="{{ old('nif', $user->nif) }}" />
        @error('nif')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <x-field.input name="default_delivery_address" label="Delivery Address" :readonly="$readonly"
            value="{{ old('default_delivery_address', $user->default_delivery_address) }}" />
        @error('default_delivery_address')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <x-field.select name='default_payment_type' label="Payment Type" width="md" :readonly="$readonly"
            value="{{ old('default_payment_type', $user->default_payment_type) }}" :options="[
        'Visa' => 'Visa',
        'PayPal' => 'PayPal',
        'MB WAY' => 'MB WAY',
    ]" />

    </div>

    <div>
        <x-photo-upload name="photo_file" label="Photo" width="md" :readonly="$readonly" deleteTitle="Delete Photo"
            :deleteAllow="true" :imageUrl="asset('storage/' . $user->photo)" />

    </div>

    <div class="mt-6">
        <x-hyperlink-text-button :href="route('transactions.history', ['account' => $user->id])"
            text="View Transaction History" type="primary" />
    </div>

</div>