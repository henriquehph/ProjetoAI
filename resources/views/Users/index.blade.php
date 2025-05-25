<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    @extends('layout')
    @section('header-title', 'List of Users')
    @section('main')
        <div class="flex justify-center">
            <div class="my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden
                     shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-50">

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>blocked</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type }}</td>
                            <td>{{ $user->blocked }}</td>
                            <td>
                                <x-table.icon-show class="ps-3 px-0.5" href="{{ route('users.show', ['user' => $user]) }}" />
                            </td>
                            <td>
                                <x-table.icon-edit class="px-0.5" href="{{ route('users.edit', ['user' => $user]) }}" />
                            </td>
                            <td>
                                <x-table.icon-delete class="px-0.5" action="{{ route('users.destroy', ['user' => $user]) }}" />
                            </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    @endsection
</body>

</html>