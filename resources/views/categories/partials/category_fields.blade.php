@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<div class="flex flex-wrap gap-6 items-start">

    <div>
        <x-field.input name="name" label="Name" :readonly="$readonly" value="{{ old('name', $category->name) }}" />
        @error('name')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

    </div>

    <div>

        <div>
            <x-photo-upload name="photo_file" label="Photo" width="md" :readonly="$readonly" deleteTitle="Delete Photo"
                :deleteAllow="true" :imageUrl="asset('storage/' . $category->image)" />

        </div>

    </div>

</div>