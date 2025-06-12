<div>
    <table class="table-auto border-collapse">
        <thead>
        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
            <th class="px-2 py-2 text-left">Product</th>
            <th class="px-2 py-2 text-left">Name</th>
            <th class="px-2 py-2 text-left">Price</th>
            <th class="px-2 py-2 text-left">Quantity</th>
            <th class="px-2 py-2 text-center">SubTotal</th>
        </tr>
        </thead>
        <tbody>
        <!-- Lista Produtos -->
        @foreach ($products as $item)
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-4 text-left"><img src="{{ $item['product']->photoFullUrl }}" alt="{{ $item['product']->name }}" style="width: 45px; height: 45px; border-radius: 8px;"></td>
                <td class="px-2 py-4 text-left">{{ $item['product']->name }}</td>
                <td class="px-2 py-4 text-center">{{ $item['product']->price }}€</td>
                <td class="px-2 py-4 text-center">{{ $item['quantity'] }}</td>
                <td class="px-2 py-4 text-right">{{ number_format($item['subtotal'], 2) }}€</td>
            </tr>
        @endforeach
        <!-- Linha de custos de envio -->
        <tr class="font-semibold">
            <td colspan="4" class="px-2 py-2 text-left">Shipping:</td>
            <td class="px-2 py-2 text-left">{{ number_format($shipping, 2) }}€</td>
        </tr>
        <!-- Linha preco total -->
        <tr class="font-bold bg-gray-200 dark:bg-gray-700">
            <td colspan="4" class="px-2 py-2 text-left">Total:</td>
            <td class="px-2 py-2 text-left">{{ number_format($total, 2) }}€</td>
        </tr>
        </tbody>
    </table>
</div>
