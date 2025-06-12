<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-center ">
            @empty($cart)
                <div class="my-8 p-12">
                    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-300">Your cart is empty</h2>
                </div>
            @else
                <div class="my-8 p-12">
                    <div class="flex flex-col lg:flex-row lg:space-x-12 space-y-8 lg:space-y-0 items-start">
                        <!-- Container Esquerda -->
                        <div class="w-2/3 p-4 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-800">
                            <div>
                                <h3 class="mb-4 text-xl text-gray-700 dark:text-gray-300">Shopping Cart List</h3>
                            </div>
                            <div class="my-8 font-base text-sm text-gray-700 dark:text-gray-300">
                                <x-cart.table :products="$cart" :showRemoveFromCart="true" />
                            </div>
                        </div>
                        <!-- Container Direita -->
                        <div class="w-2/3 p-4 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-800">
                            <div>
                                <h3 class="mb-4 text-xl text-gray-700 dark:text-gray-300">Shopping Cart Confirmation</h3>
                            </div>
                            <form action="{{ route('cart.confirm') }}" method="post" class="space-y-4">
                                @csrf
                                <div class="flex flex-col lg:flex-row lg:space-x-4 space-y-4 lg:space-y-0">
                                    @auth
                                        <input name="Nif" placeholder="NIF" value="{{ auth()->user()->nif }}"
                                            class="flex-grow border border-gray-300 rounded-md px-4 py-2" />
                                        <input name="Address" placeholder="User Address"
                                            value="{{ auth()->user()->default_delivery_address }}"
                                            class="flex-grow border border-gray-300 rounded-md px-4 py-2" />
                                    @else
                                        <input name="Nif" placeholder="NIF" value="{{ old('nif') }}"
                                            class="flex-grow border border-gray-300 rounded-md px-4 py-2" />
                                        <input name="Address" placeholder="User Address"
                                            value="{{ old('default_delivery_address') }}"
                                            class="flex-grow border border-gray-300 rounded-md px-4 py-2" />
                                    @endauth
                                </div>
                                <div class="p-4 text-gray-700 dark:text-gray-300">
                                    <div class="flex justify-between mb-2">
                                        <span>Shipping:</span>
                                        <span>TODO€</span>
                                    </div>
                                    <div class="flex justify-between font-semibold text-lg border-t border-gray-300 pt-2">
                                        <span>Total:</span>
                                        <span>Poo poo</span>
                                    </div>
                                </div>
                                <div class="flex space-x-4 justify-center">
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                                        Confirm
                                    </button>
                                    <form action="{{ route('cart.destroy') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                                            Clear Cart
                                        </button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endempty
        </div>
    </div>
</x-app-layout>
