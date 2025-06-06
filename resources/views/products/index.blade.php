<x-layouts.main-content :title="__('Catalog')"
                        heading="Catalog"
                        subheading="List of products">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div x-data="{ open: false }">
            <div class="flex justify-end">
                <flux:button variant="primary" @click="open = !open">
                    <flux:icon.funnel class="px-0.5"/>
                    Filters
                </flux:button>
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
                    <div class="flex items-center gap-4 mb-4">
                        <flux:button variant="primary" href="{{ route('products.create') }}">Create a new product</flux:button>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-4 font-base text-sm text-gray-700 dark:text-gray-300">
                <x-products.grid :products="$products"
                                    :showView="true"
                                    :showEdit="true"
                                    :showDelete="true"
                                    :showAddToCart="true"
                                    :showRemoveFromCart="false"
                    />
                </div>
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
    </div>
</x-layouts.main-content>


