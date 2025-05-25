@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<x-field.input name="name" label="Name" :readonly="$readonly" value="{{ $user->name }}" />

<x-field.input name="Email" label="Email" :readonly="$readonly" value="{{ $email }}" />

<x-field.select name="Type" label="Type" width="md" :readonly="$readonly" value="{{ $user->type }}" :options="[
        'pending_member' => 'Pending Activation',
        'board' => 'Board Member',
        'member' => 'Active Member',
        'employee' => 'Employee',
    ]" />


<x-field.select name="Blocked" label="Blocked" width="md" :readonly="$readonly" value="{{ $user->blocked}}" :options="[
        '1' => 'Blocked',
        '0' => 'Not Blocked',
    ]" />


<x-field.select name="Gender" label="Gender" width="md" :readonly="$readonly" value="{{ $gender }}" :options="[
        'M' => 'Male',
        'F' => 'Female',
    ]" />

@if ($user->type != 'Employee')
    <x-field.input name="Nif" label="nif" :readonly="$readonly" value="{{ $user->nif }}" />
    <x-field.input name="Delivery Address" label="gender" :readonly="$readonly"
        value="{{ $user->default_delivery_address }}" />
    <x-field.select name="Payment Type" label="Payment Type" width="md" :readonly="$readonly"
        value="{{ $user->default_payment_type }}" :options="[
                'visa' => 'Visa',
                'paypal' => 'PayPal',
                'mb way' => 'MB WAY',
            ]" />
@endif