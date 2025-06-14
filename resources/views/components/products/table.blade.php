<div>
    <table class="table-auto border-collapse">
        <thead>
        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
            <th class="px-2 py-2 text-left">Photo</th>
            <th class="px-2 py-2 text-left">Id</th>
            <th class="px-2 py-2 text-left">Category</th>
            <th class="px-2 py-2 text-left">Name</th>
            <th class="px-2 py-2 text-left">Price(€)</th>
            <th class="px-2 py-2 text-left">Stock</th>
            <th class="px-2 py-2 text-center">Description</th>
            <th class="px-2 py-2 text-center">Discount Min Quantity</th>
            <th class="px-2 py-2 text-center">Discount(€)</th>
            <th class="px-2 py-2 text-center">Stock Lower Limit</th>
            <th class="px-2 py-2 text-center">Stock Upper Limit</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-4 text-left"><img src="{{ $product->photoFullUrl }}" alt="{{ $product->name }}" style="width: 45px; height: 45px; border-radius: 8px;"></td>
                <td class="px-2 py-4 text-left">{{ $product->id }}</td>
                <td class="px-2 py-4 text-left">{{ $product->category }}</td>
                <td class="px-2 py-4 text-left">{{ $product->name }}</td>
                <td class="px-2 py-4 text-left">{{ $product->price }}</td>
                <td class="px-2 py-4 text-left">{{$product->stock }}</td>
                <td class="px-2 py-4 text-right">{{ $product->description }}</td>
                <td class="px-2 py-4 text-right">{{ $product->discount_min_qty }}</td>
                <td class="px-2 py-4 text-right">{{ $product->discount }}</td>
                <td class="px-2 py-4 text-right">{{ $product->stock_lower_limit }}</td>
                <td class="px-2 py-4 text-right">{{ $product->stock_upper_limit }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
