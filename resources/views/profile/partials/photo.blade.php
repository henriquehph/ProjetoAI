<div>
    <x-input-label for="profile_photo" :value="__('Profile Photo')" />
    <div class="mt-1 block w-full shadow sm:rounded-lg p-2 bg-white rounded-lg">
        <!-- Assuming the photo is stored in public/images/ -->
        <img src="{{ asset($user->photo)}}" alt="Profile Photo" class="max-w-xs rounded-lg" />
    </div>
</div>