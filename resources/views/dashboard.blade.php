@php
    use App\Models\Settings;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Manage your application settings here') }}
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100 text-xl font-semibold">
                    {{ __("Board Page") }}
                </div>

                <div class="p-6 flex items-center justify-between text-gray-900 dark:text-gray-100">
                    <h1 class="text-lg font-medium">Users List</h1>
                    <x-hyperlink-text-button :href="route('users.index')" text="Settings" type="success" />
                </div>

                <div class="p-6 flex items-center justify-between text-gray-900 dark:text-gray-100">
                    <h1 class="text-lg font-medium">Change membership fee</h1>
                    <x-hyperlink-text-button :href="route('settings.show')" text="Settings" type="success" />
                </div>

                <div class="p-6 flex items-center justify-between text-gray-900 dark:text-gray-100">
                    <h1 class="text-lg font-medium">Manage categories</h1>
                    <x-hyperlink-text-button :href="route('categories.index')" text="Settings" type="success" />
                </div>

                <div class="p-6 flex items-center justify-between text-gray-900 dark:text-gray-100">
                    <h1 class="text-lg font-medium">Manage Produtcs</h1>
                    <x-hyperlink-text-button :href="route('categories.index')" text="Settings" type="success" />
                </div>

            </div>

        </div>
    </div>
</x-app-layout>