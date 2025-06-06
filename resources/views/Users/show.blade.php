@extends('Layout')

@section('header-title', $user->name)

@section('main')
    <div class="flex flex-col space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
            <div class="max-full">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Show User "{{ $user->name }}"
                        </h2>
                    </header>

                    @include('Users.partials.user_fields', ['mode' => 'show'])

                </section>
            </div>
        </div>
    </div>



@endsection