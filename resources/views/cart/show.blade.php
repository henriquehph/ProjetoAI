<x-layouts.main-content title="Cart"
                        heading="Shopping Cart"
                        subheading="Products at the shopping cart">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl ">
        <div class="flex justify-start ">
            @empty($cart)
                <div class="my-4 p-6 ">
                    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-300">Your cart is empty</h2>
                </div>
            @else
                <div class="my-4 p-6 ">
                    <div class="my-4 font-base text-sm text-gray-700 dark:text-gray-300">
                        <x-cart.table :products="$cart"
                            :showRemoveFromCart="true"
                        />
                    </div>
                    <div class="mt-12">
                        <div>
                            <h3 class="mb-4 text-xl">Shopping Cart Confirmation </h3>
                        </div>
                        <div class="flex justify-between items-start space-x-4">
                            <form action="{{ route('cart.confirm') }}" method="post" class="flex space-x-4">
                                @csrf
                                <!-- Lógica de acordo com o login do user -->
                                @auth
                                <flux:input name="Nif" label="NIF" value="{{ auth()->user()->nif }}"/>
                                <flux:input name="Address" label="User Address" value="{{ auth()->user()->default_delivery_address }}"/>
                                @else
                                <flux:input name="Nif" label="NIF" value="{{ old('nif') }}"/>
                                <flux:input name="Address" label="User Address" value="{{ old('default_delivery_address') }}"/>
                                @endauth
                                <flux:button variant="primary" type="submit" class="mt-[1.7rem]">Confirm</flux:button>
                            </form>
                            <form action="{{ route('cart.destroy') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <flux:button variant="danger" type="submit" class="mt-[1.7rem]">Clear Cart</flux:button>
                            </form>
                        </div>
                    </div>
                </div>
            @endempty
        </div>
    </div>
</x-layouts.main-content>
