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
<<<<<<< HEAD
                    <div class="flex justify-between">
                        <!-- Card Balance -->
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xs">
                                <p class="text-lg text-gray-700 dark:text-gray-300 font-semibold">
                                    Card Balance: €{{ number_format($balance, 2) }}
                                </p>
                                <a href="{{ url('/add-funds') }}">
                                    <button type="button">Add Funds</button> <!-- Button to add funds -->
                                </a>
                            </div>
                        </div>

                        @if (Auth::user()->type === 'pending_member')
                            <!-- Membership Payment -->
                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                <div class="max-w-xs">
                                    <p class="text-lg text-gray-700 dark:text-gray-300 font-semibold">
                                        UPGRADE:
                                    </p>
                                    <a href="{{ route('payments.pay') }}">
                                        <button type="button">Pay Membership Fee (€100)</button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <br>

                    <!-- Display Membership Status -->
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <p class="text-lg text-gray-700 dark:text-gray-300 font-semibold">
                                Membership Status: {{ $membership === 'pending_member' ? 'Pending' : 'Active' }} <!-- Show membership status -->
                            </p>
                        </div>
                    </div>

                    <br>

                    <!-- Update Profile Form -->
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <br>
=======

                    @if($user->type == 'member' || $user->type == 'board' || $user->type == 'pending_member')

                                @include('profile.partials.membership_info', ['user' => $user]) <!-- HTML da membership -->

                                <br>

                                <!-- Update Profile Form -->
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <br>

                    @endif
>>>>>>> Projeto

            <!-- Update Password Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

<<<<<<< HEAD
            <!-- Delete User Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
=======
            @if($user->type == 'member' || $user->type == 'board' || $user->type == 'pending_member')

                <!-- Delete User Form -->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
>>>>>>> Projeto
        </div>
    </div>
</x-app-layout>