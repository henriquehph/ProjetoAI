@extends('layout')

@section('header-title', 'Transaction History')

@section('main')
<div class="max-w-4xl mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded shadow">

    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Transaction History</h2>

    @if ($transactions->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">No transactions found.</p>
    @else
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700">
                    <th class="border border-gray-300 px-4 py-2">Date</th>
                    <th class="border border-gray-300 px-4 py-2">Type</th>
                    <th class="border border-gray-300 px-4 py-2">Value (€)</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 px-4 py-2">{{ $transaction->date }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($transaction->type) }}</td>
                        <td class="border border-gray-300 px-4 py-2">€{{ number_format($transaction->value, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ str_replace('_', ' ', ucfirst($transaction->debit_type ?? $transaction->credit_type ?? '-')) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection