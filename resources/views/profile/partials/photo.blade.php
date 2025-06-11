<div>

    {{ $user->photo }}
    <x-photo-upload name="photo_file" label="Photo" width="md" :readonly="$readonly" deleteTitle="Delete Photo"
        :deleteAllow="true" :imageUrl="asset('storage/' . $user->photo)" />

</div>