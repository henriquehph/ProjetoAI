<div>
    <table class="table-auto border-collapse">
        <thead>
        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
            <th class="px-2 py-2 text-left">Product</th>
            <th class="px-2 py-2 text-left">Name</th>
            <th class="px-2 py-2 text-left">Price</th>
            <th class="px-2 py-2 text-left">Stock</th>
            <th class="px-2 py-2 text-center">Description</th>
            <!-- Falta as permissões para view,edit,delete -->
            @if($showView)
                <th></th>
            @endif
            @if($showEdit)
                <th></th>
            @endif
            @if($showDelete)
                <th></th>
            @endif
            @if($showAddToCart)
                <th></th>
            @endif
            @if($showRemoveFromCart)
                <th></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-4 text-left"><img src="{{ $product->photoFullUrl }}" alt="{{ $product->name }}" style="width: 45px; height: 45px; border-radius: 8px;"></td>
                <td class="px-2 py-4 text-left">{{ $product->name }}</td>
                <td class="px-2 py-4 text-left">{{ $product->price }}€</td>
                <td class="px-2 py-4 text-left">{{$product->stock }}</td>
                <td class="px-2 py-4 text-right">{{ $product->description }}</td>
                @if($showView)
                    <td class="ps-2 px-0.5">
                        <a href="{{ route('products.show', ['product' => $product]) }}">
                            <flux:icon.eye class="size-5 hover:text-green-600" />
                        </a>
                    </td>
                @endif
                @if($showEdit)
                    <td class="px-0.5">
                        <a href="{{ route('products.edit', ['product' => $product]) }}">
                            <flux:icon.pencil-square class="size-5 hover:text-blue-600" />
                        </a>
                    </td>
                @endif
                @if($showDelete)
                    <td class="px-0.5">
                        <form method="POST" action="{{ route('products.destroy', ['product' => $product]) }}" class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <flux:icon.trash class="size-5 hover:text-red-600" />
                            </button>
                        </form>
                    </td>
                @endif
                @if($showAddToCart)
                    <td class="pl-4">
                        <form method="POST" action="{{ route('cart.add', ['product' => $product]) }}" class="flex items-center">
                            <div class="flex items-center border px-0">
                                <input type="number" name="quantity" value="1" min="1" class="w-11 text-center"/>
                            </div>
                            @csrf
                            <button type="submit">
                                <flux:icon.shopping-cart class="size-5 hover:text-green-600" />
                            </button>
                        </form>
                    </td>
                @endif
                @if($showRemoveFromCart)
                    <td class="pl-4">
                        <form method="POST" action="{{ route('cart.remove', ['product' => $product]) }}" class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <flux:icon.minus-circle class="size-5 hover:text-red-600" />
                            </button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
