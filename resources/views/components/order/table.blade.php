<div>
    <table class="table-auto border-collapse">
        <thead>
        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
            <th class="px-2 py-2 text-left">Order Id</th>
            <th class="px-2 py-2 text-left">User Id</th>
            <th class="px-2 py-2 text-left">Date</th>
            <th class="px-2 py-2 text-left">Status</th>
            <th class="px-2 py-2 text-center">Total Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-4 text-left">{{ $order->id }}</td>
                <td class="px-2 py-4 text-left">{{ $order->member_id }}</td>
                <td class="px-2 py-4 text-left">{{$order->date }}</td>
                <td class="px-2 py-4 text-right">
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-300 text-yellow-800',
                            'completed' => 'bg-green-300 text-green-800',
                            'canceled' => 'bg-red-300 text-red-800',
                        ];

                        $status = strtolower($order->status);
                        $classes = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                    @endphp

                    <span class="px-2 py-1 rounded-full text-sm font-semibold {{ $classes }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-2 py-4 text-right">{{ $order->total }}€</td>
            </tr>
        @endforeach
        <!-- 'pdf_receipt','cancel_reason', -->
    </table>
</div>
