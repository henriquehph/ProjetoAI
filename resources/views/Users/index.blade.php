@extends('layout')

@section('header-title', 'List of Users')

@section('main')
    <div class="flex justify-center">



        <div class="my-4 p-6 bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-50">

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex items-center gap-4 mb-4">
                <x-hyperlink-text-button href="{{ route('users.create') }}" text="Create a new User" type="success" />
            </div>
            <div class="font-base text-sm text-gray-700 dark:text-gray-300">



                <div>
                    @include('users.partials.filter-form')
                </div>

                <br>

                <table class="table-auto border-collapse">
                    <thead>
                        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
                            <th class="px-2 py-2 text-left hidden lg:table-cell">ID</th>
                            <th class="px-2 py-2 text-left">Name</th>
                            <th class="px-2 py-2 text-left">Email</th>
                            <th class="px-2 py-2 text-right hidden sm:table-cell">Type</th>
                            <th class="px-2 py-2 text-right hidden sm:table-cell">Blocked</th>
                            <th class="px-2 py-2 text-right hidden sm:table-cell">Deleted At</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                                <td class="px-2 py-2 text-left hidden lg:table-cell">{{ $user->id }}</td>
                                <td class="px-2 py-2 text-left">{{ $user->name }}</td>
                                <td class="px-2 py-2 text-left">{{ $user->email }}</td>
                                <td class="px-2 py-2 text-right hidden sm:table-cell">{{ $user->type }}</td>
                                <td class="px-2 py-2 text-right hidden sm:table-cell">{{ $user->blocked }}</td>
                                <td class="px-2 py-2 text-right hidden sm:table-cell">{{ $user->deleted_at ?? 'Active' }}</td>
                                <td>
                                    <x-table.icon-show class="ps-3 px-0.5"
                                        href="{{ route('users.show', ['user' => $user]) }}" />
                                </td>
                                <td>
                                    <x-table.icon-edit class="px-0.5" href="{{ route('users.edit', ['user' => $user]) }}" />
                                </td>
                                <td>
                                    <x-table.icon-delete class="px-0.5"
                                        action="{{ route('users.destroy', ['user' => $user], ) }}" />
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>

        </div>

    </div>
@endsection