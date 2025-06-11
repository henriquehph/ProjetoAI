<x-layouts.main-content :title="__('Orders')"
                        heading="List of orders"
                        subheading="">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl ">
        <div class="flex justify-start ">
            <div class="my-4 p-6 ">
            </div>
        </div>
        <div class="my-4 font-base text-sm text-gray-700 dark:text-gray-300">
                <x-order.table :orders="$orders"
                                    :showView="true"
                                    :showEdit="true"
                                    :showDelete="true"
                                    :showAddToCart="true"
                                    :showRemoveFromCart="false"
                    />
                </div>
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
    </div>
</x-layouts.main-content>


