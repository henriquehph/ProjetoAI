@extends('layout')

@section('header-title', $user->name)

@section('main')
    <div class="flex flex-col space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
            <div class="max-full">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Edit User "{{ $user->name }}"
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 mb-6">
                            Click on "Save" button to store the information.
                        </p>
                    </header>

                    <!-- Update User Form -->
                    @include('Users.partials.update-user-information-form')
                </section>
            </div>
        </div>
    </div>
@endsection