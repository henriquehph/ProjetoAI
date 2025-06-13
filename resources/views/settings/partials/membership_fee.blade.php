@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<div>


    <x-field.input name="membership_fee" label="Membership Fee" :readonly="$readonly" value="{{ old('membership_fee', $membership_fee) }}" />
    @error('name')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
    
</div>