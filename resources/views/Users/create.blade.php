@extends('Layout')

@section('header-title', "Create User")

@section('main')
    <div class="flex flex-col space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
            <div class="max-full">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Create User
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 mb-6">
                            Click on "Save" button to create the user.
                        </p>
                    </header>

                    <form method="POST" action="{{ route('users.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-6 space-y-4">
                            @include('users.partials.user_fields', ['mode' => 'create'])
                        </div>

                        <br>

                        <div>
                            @include('users.partials.password-form')
                        </div>


                        <br>

                        <div class="flex items-center gap-4">

                            <x-submit-button text="Save" type="success" />
                            <x-hyperlink-text-button href="{{ route('users.index') }}" text="Cancel" type="primary" />

                        </div>


                    </form>

                </section>
            </div>
        </div>
    </div>
@endsection