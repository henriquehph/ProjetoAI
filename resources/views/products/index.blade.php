<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List of Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

                    @can('create', App\Models\Product::class)
                        <!-- Create Product Button -->
                        <div class="flex items-center gap-4 mb-4">
                            <x-hyperlink-text-button href="{{ route('products.create') }}" text="Create a new Product" type="success" />
                        </div>

                    @endcan

                        <div x-data="{ open: false }">
                            <div class="flex justify-end">
                                <button variant="primary" @click="open = !open">Filters</button>
                            </div>
                            <div x-show="open" class="flex justify-start">
                                <div class="my-4 p-6 w-full">
                                    <x-products.filter-card
                                        :filterAction="route('products.index')"
                                        :resetUrl="route('products.index')"
                                        :name="old('name', $filterByName)"
                                        :price="old('price', $filterPrice)"
                                        :category="old('category', $filterByCategories)"
                                        :categories="$categories"
                                        :discount="old('discount', $filterByDiscount)"
                                        class="mb-6"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="my-4 font-base text-sm text-gray-700 dark:text-gray-300">
                            <x-products.grid
                                :products="$products"
                                :showView="true"
                            />
                        </div>

                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>