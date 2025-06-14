@extends('layout')

@section('header-title', 'New Transaction')

@section('main')
    <div class="max-w-md mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Confirm Transaction</h2>

        <form method="POST" action="{{ route('transactions.store') }}">
            @csrf

            <input type="hidden" name="value" value="{{ $value }}">
            <input type="hidden" name="debit_type" value="{{ $debit_type }}">
            <input type="hidden" name="from" value="{{ request('from') }}">
            @if (isset($order))
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Type:</label>
                <p class="text-gray-900 dark:text-gray-100">{{ ucfirst(str_replace('_', ' ', $debit_type)) }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Value:</label>
                <p class="text-gray-900 dark:text-gray-100">€{{ number_format($value, 2) }}</p>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Confirm
                </button>
                <a href="{{ request('from') ?? route('home') }}"
                    class="bg-gray-400 text-gray-800 px-4 py-2 rounded hover:bg-gray-500 transition flex items-center justify-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection