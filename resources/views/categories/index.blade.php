@extends('layout')

@section('header-title', 'List of Categories')

@section('main')
    <div class="flex justify-center">



        <div class="my-4 p-6 bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-50">

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex items-center gap-4 mb-4">
                <x-hyperlink-text-button href="{{ route('categories.create') }}" text="Create a new Category"
                    type="success" />
            </div>
            <div class="font-base text-sm text-gray-700 dark:text-gray-300">



                <div>
                    @include('categories.partials.filter-form')
                </div>

                <br>

                <table class="table-auto border-collapse">
                    <thead>
                        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
                            <th class="px-2 py-2 text-left hidden lg:table-cell">ID</th>
                            <th class="px-2 py-2 text-left">Name</th>
                            <th class="px-2 py-2 text-left">Deleted at</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                                <td class="px-2 py-2 text-left hidden lg:table-cell">{{ $category->id }}</td>
                                <td class="px-2 py-2 text-left">{{ $category->name }}</td>
                                <td class="px-2 py-2 text-left">{{ $category->deleted_at ?? "Active" }}</td>

                                <td>
                                    <x-table.icon-show class="ps-3 px-0.5"
                                        href="{{ route('categories.show', ['category' => $category]) }}" />
                                </td>
                                <td>
                                    <x-table.icon-edit class="px-0.5"
                                        href="{{ route('categories.edit', ['category' => $category]) }}" />
                                </td>
                                <td>
                                    <x-table.icon-delete class="px-0.5"
                                        action="{{ route('categories.destroy', ['category' => $category], ) }}" />
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $categories->links() }}
            </div>

        </div>

    </div>
@endsection