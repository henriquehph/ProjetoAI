<x-layouts.main-content :title="$order->id"
                        :heading="'Order '. $order->id">
    <div class="flex flex-col space-y-6">
        <div class="max-full">
            <section>
                <div class="mt-6 space-y-4">
                    @include('products.partials.fields', ['mode' => 'show'])
                </div>
                <h3 class="pt-16 pb-4 text-lg font-medium text-gray-900
                            dark:text-gray-100">
                    list of products
                </h3>
                <@include('orders.partials.fields', ['mode' => 'show'])
            </section>
        </div>
    </div>
</x-layouts.main-content>
