<x-app-layout>
    <x-slot name="header">
        <div class="space-x-4">
            <!-- Pedidos pendentes -->
            <x-nav-link :href="route('orders.index', ['status' => 'pending'])" :active="request('status') === 'pending'">
                {{ __('Pending Orders') }}
            </x-nav-link>
            <!-- Pedidos completos -->
            <x-nav-link :href="route('orders.index', ['status' => 'completed'])" :active="request('status') === 'completed'">
                {{ __('Completed Orders') }}
            </x-nav-link>
            <!-- Pedidos cancelados -->
            <x-nav-link :href="route('orders.index', ['status' => 'canceled'])" :active="request('status') === 'canceled'">
                {{ __('Canceled Orders') }}
            </x-nav-link>
            <!-- Produtos sem stock -->
            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                {{ __('Out of stock products') }}
            </x-nav-link>
            <!-- Produtos abaixo do minimo de stock -->
            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                {{ __('Products below minimum stock') }}
            </x-nav-link>
        </div>
    </x-slot>
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <!-- Opção Filtros -->
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div x-data="{ open: false }">
                            <div class="flex justify-end">
                                <button variant="primary" @click="open = !open">Filters<button>
                            </div>
                            <div x-show="open" class="flex justify-start">
                                <div class="my-4 p-6 w-full">
                                    <x-order.filter-card
                                        :filterAction="route('orders.index',['status' => $status])"
                                        :resetUrl="route('orders.index',['status' => $status])"
                                        :price="old('price', $filterPrice)"
                                        :date="old('date', $filterDate)"
                                        :status="$status"
                                        :member_id="old('member_id', $filterId)"
                                        class="mb-6"
                                    />
                                </div>
                            </div>
                        </div>
        </div>
        <!-- Lista de pedidos -->
        @if ($orders->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-400 mt-6">
                @if (!empty($filterId))
                    No orders found for member ID <strong>{{ $filterId }}</strong>.
                @else
                No orders found for the selected filter.
                @endif
            </p>
        @else
            <div class="my-4 flex justify-center font-base text-sm text-gray-700 dark:text-gray-300">
                <div class="p-4 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-800">
                    <x-order.table
                        :orders="$orders"
                        :showView="true" />
                </div>
            </div>
            <div class="flex justify-center mb-6">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-gray-900 dark:text-gray-100 text-xl font-semibold">
                    {{ __("Order Options") }}
                </div>
                
                <div class="p-3 text-gray-900 dark:text-gray-100">
                    <p class="text-lg font-medium mb-4">Select an order ID to view details or perform actions.</p>
                </div>
                <div class="p-6 flex items-start justify-between ">
                    <form method="post" action="{{ route('orders.cancelOrder', $order) }}">
                        @csrf
                        @method('POST')
                        <div class="flex items-center">
                            <x-text-input class="p-2"  label="Order ID" name="order_id" placeholder="Enter Order ID" />
                            <x-submit-button class="p-2" text="Cancel Order" type="primary" />
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
