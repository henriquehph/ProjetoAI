@php
    $fee = 100;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Membership Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="text-red-500 mb-4">{{ session('error') }}</div>
            @endif
            @if(session('message'))
                <div class="text-green-500 mb-4">{{ session('message') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <p class="mb-4 text-gray-700 dark:text-gray-300">
                    Membership fee: €{{ $fee }}<br>
                    Do you want to proceed with the payment?
                </p>

                <form method="POST" action="{{ route('membership.process') }}">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Confirm & Pay
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>