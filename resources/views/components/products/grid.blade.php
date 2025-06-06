<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-">
        @foreach ($products as $product)
            <div class="bg-white dark:bg-zinc-800 border dark:border-zinc-700 rounded-lg shadow p-4 flex flex-col">
                <img src="{{ $product->photoFullUrl }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md" />
                <h3 class="px-2 py-4 text-left">{{ $product->name }}</h3>
                <p class="px-2 py-4 text-left">{{ $product->price }}€</p>
                <div class="mt-auto pt-2 flex justify-between items-center">
                    <form method="POST" action="{{ route('cart.add', ['product' => $product]) }}" class="flex items-center gap-4">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" class="w-20 px-2 py-1 border dark:border-zinc-700 rounded-md text-center"/>
                        <flux:button variant="primary" type="submit">Add to Cart</flux:button>
                    </form>
                </div>
                <div class="mt-auto pt-2 flex justify-between items-center">
                    <span class="px-2 py-4 text-left">Description: {{ $product->description }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

