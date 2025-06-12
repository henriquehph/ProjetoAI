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
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome Admin :name", ['name' => Auth::user()->email ]) }} 
                    
                        <p class="m-4 text-lg text-gray-600 dark:text-gray-400">
                            {{ __("Manage categories, membership fees, shipping costs from here") }}
                        </p>
                            
                                @csrf
                                <x-input-label for="name" :value="__('Membership Fee')" />
                                <div class="m-3  text-black block w-48 border-2 border-gray-300 shadow sm:rounded-lg p-2 bg-white rounded-lg">
                                    <!-- get membership from settings-->
                                    {{__(Settings::first()->membership_fee) }} €
                                </div>

                                <x-input-label for="name" :value="__('Shipping Costs')" />
                                <div class="m-3 text-black block w-48 border-2 border-gray-300 shadow sm:rounded-lg p-2 bg-white rounded-lg">
                                    {{__(Settings::first()->shipping_costs ?? 0) }} €
                                </div>

                            

                            
                                @csrf
                                <x-input-label for="name" :value="__('New Category Name')" />
                                <div class="m-3 text-black block w-full border-2 border-gray-300 shadow sm:rounded-lg p-2 bg-white rounded-lg">
                                    {{__( "New Category") }}
                                </div>
                        <div class="flex items-center gap-4">

                            <x-submit-button text="Save" type="success" />
                            <x-hyperlink-text-button href="{{ route('users.index') }}" text="Cancel" type="primary" />

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
