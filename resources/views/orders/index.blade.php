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
            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('users.index')">
                {{ __('Out of stock products') }}
            </x-nav-link>
            <!-- Produtos abaixo do minimo de stock -->
            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('users.index')">
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
                                        class="mb-6"
                                    />
                                </div>
                            </div>
                        </div>
        </div>
        <!-- Lista de pedidos -->
        @if ($orders->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-400 mt-6">
                No orders found for the selected filter.
            </p>
        @else
            <div class="my-4 flex justify-center font-base text-sm text-gray-700 dark:text-gray-300">
                <div class="p-4 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-800">
                    <x-order.table :orders="$orders" />
                </div>
            </div>
            <div class="flex justify-center mb-6">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
