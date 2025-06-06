<div>
    <table class="table-auto border-collapse">
        <thead>
        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
            <th class="px-2 py-2 text-left">Product</th>
            <th class="px-2 py-2 text-left">Name</th>
            <th class="px-2 py-2 text-left">Price</th>
            <th class="px-2 py-2 text-left">Quantity</th>
            <th class="px-2 py-2 text-center">subTotal Price</th>
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
                <td class="px-2 py-4 text-left">{{ $product->quantity }}TODO</td> <!-- TODO -->
                <td class="px-2 py-4 text-right">{{ $product->subtotal }}TODO</td> <!-- TODO -->
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

        <!-- Linha de custos de envio -->
        <tr class="font-semibold">
            <td colspan="4" class="px-2 py-2 text-left">Shipping:</td>
            <td class="px-2 py-2 text-left">{{ $product->price }}€ Falta implementar</td>
        </tr>

        <!-- Linha preco total -->
        <tr class="font-bold bg-gray-200 dark:bg-gray-700">
            <td colspan="4" class="px-2 py-2 text-left">Total:</td>
            <td class="px-2 py-2 text-left">{{ $product->price }}€ Falta implementar</td>
        </tr>
        </tbody>
    </table>
</div>
