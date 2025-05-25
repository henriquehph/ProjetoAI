@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<x-field.input name="name" label="Name" width="md" :readonly="$readonly || ($mode == 'edit')"
    value="{{ $user->name }}" />
<x-field.select name="gender" label="Gender" width="md" :readonly="$readonly" value="{{ $user->gender }}" :options="[
        'Male' => 'M',
        'Female' => 'F',
        'Other' => 'O'
    ]" />
<x-field.input name="nif" label="Nif" :readonly="$readonly" value="{{ $user->nif }}" />


