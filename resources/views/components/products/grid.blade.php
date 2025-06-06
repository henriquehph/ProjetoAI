<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow p-4 flex flex-col">
                <img src="{{ $product->photoFullUrl }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md" />
                <h3 class="px-2 py-4 text-left">{{ $product->name }}</h3>
                <p class="px-2 py-4 text-left">{{ $product->price }}€</p>
                <div class="mt-auto pt-2 flex justify-between items-center">
                    <form method="POST" action="{{ route('cart.add', ['product' => $product]) }}" class="flex items-center gap-4">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" class="w-20 px-2 py-1 border dark:border-gray-700 rounded-md text-center"/>
                        <button variant="primary" type="submit" class="border dark:border-gray-700 rounded-md px-4 py-2 shadow p-4">Add to Cart</button>
                    </form>
                </div>
                <div class="mt-auto pt-2 flex justify-between items-center">
                    <span class="px-2 py-4 text-left">Description: {{ $product->description }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

