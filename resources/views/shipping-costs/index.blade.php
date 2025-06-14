@extends('layout')

@section('header-title', 'Shipping Costs')

@section('main')
    <div class="flex justify-center">
        <div class="my-4 p-6 dark:bg-gray-900 shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-50">

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex items-center gap-4 mb-4">
                <x-hyperlink-text-button
                    href="{{ route('shipping-costs.create') }}"
                    text="Add a new shipping cost interval"
                    type="success"
                />
            </div>

            <div class="font-base text-sm text-gray-700 dark:text-gray-300">
                @include('shipping-costs.partials.filter-form')
                <br>

                <table class="table-auto border-collapse w-full">
                    <thead>
                        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
                            <th class="px-2 py-2 text-left hidden lg:table-cell">ID</th>
                            <th class="px-2 py-2 text-left">Min Threshold</th>
                            <th class="px-2 py-2 text-left">Max Threshold</th>
                            <th class="px-2 py-2 text-right hidden sm:table-cell">Shipping Cost</th>
                            <th class="px-2 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippingCosts as $shippingCost)
                            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                                <td class="px-2 py-2 text-left hidden lg:table-cell">{{ $shippingCost->id }}</td>
                                <td class="px-2 py-2 text-left">{{ $shippingCost->min_value_threshold }}</td>
                                <td class="px-2 py-2 text-left">{{ $shippingCost->max_value_threshold }}</td>
                                <td class="px-2 py-2 text-right hidden sm:table-cell">{{ $shippingCost->shipping_cost }}</td>
                                <td class="px-2 py-2 text-right">
                                    <x-table.icon-edit
                                        class="inline-block px-1"
                                        href="{{ route('shipping-costs.edit', ['shipping_cost' => $shippingCost]) }}"
                                    />
                                    <x-table.icon-delete
                                        class="inline-block px-1"
                                        action="{{ route('shipping-costs.destroy', ['shipping_cost' => $shippingCost]) }}"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $shippingCosts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection