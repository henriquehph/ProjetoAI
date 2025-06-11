@php
    $readonly = false; // or false, depending on your use case
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">

                    @can('editProfileMemberDetails', $user)

                                @include('profile.partials.membership_info', ['user' => $user]) <!-- HTML da membership -->

                                <br>

                                <!-- Update Profile Form -->
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <br>

                    @endcan

            <!-- Update Password Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

           @can

                <!-- Delete User Form -->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endcan
        </div>
    </div>
</x-app-layout>