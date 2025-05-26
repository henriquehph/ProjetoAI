@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp


<x-field.input name="name" label="Name" :readonly="$readonly" value="{{ $user->name }}" />
@error('name')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<x-field.input name="email" label="Email" :readonly="$readonly" value="{{ $email }}" />
@error('email')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<x-field.select name="type" label="Type" width="md" :readonly="$readonly" value="{{ $user->type }}" :options="[
        'pending_member' => 'Pending Activation',
        'board' => 'Board Member',
        'member' => 'Active Member',
        'employee' => 'Employee',
    ]" />


<x-field.select name="blocked" label="Blocked" width="md" :readonly="$readonly" value="{{ $user->blocked}}" :options="[
        '1' => 'Blocked',
        '0' => 'Not Blocked',
    ]" />


<x-field.select name="gender" label="Gender" width="md" :readonly="$readonly" value="{{ $user->gender }}" :options="[
        'M' => 'Male',
        'F' => 'Female',
    ]" />


<x-field.input name="nif" label="NIF" :readonly="$readonly" value="{{ $user->nif }}" />
@error('nif')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<x-field.input name="default_delivery_address" label="Delivery Address" :readonly="$readonly"
    value="{{ $user->default_delivery_address }}" />
@error('default_delivery_address')
    <div class="text-red-500">{{ $message }}</div>
@enderror
<x-field.select name='default_payment_type' label="Payment Type" width="md" :readonly="$readonly"
    value="{{ $user->default_payment_type }}" :options="[
        'Visa' => 'Visa',
        'PayPal' => 'PayPal',
        'MB WAY' => 'MB WAY',   
    ]" />