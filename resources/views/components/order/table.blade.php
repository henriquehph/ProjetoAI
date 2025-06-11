<div>
    <table class="table-auto border-collapse">
        <thead>
        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
            <th class="px-2 py-2 text-left">Order Id</th>
            <th class="px-2 py-2 text-left">User Photo</th>
            <th class="px-2 py-2 text-left">User Id</th>
            <th class="px-2 py-2 text-left">Date</th>
            <th class="px-2 py-2 text-left">Status</th>
            <th class="px-2 py-2 text-center">Total Price</th>
            @if($showView)
                <th></th>
            @endif
            @if($showEdit)
                <th></th>
            @endif
            @if($showDelete)
                <th></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-4 text-left">{{ $order->id }}</td>
                <td class="px-2 py-4 text-left">TODO</td> <!-- TODO -->
                <td class="px-2 py-4 text-left">{{ $order->member_id }}</td> <!-- TODO -->
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
                 @if($showView)
                    <td class="ps-2 px-0.5">
                        <a href="{{ route('orders.show', ['order' => $order]) }}">
                            <flux:icon.eye class="size-5 hover:text-green-600" />
                        </a>
                    </td>
                @endif
                @if($showEdit)
                    <td class="px-0.5">
                        <a href="{{ route('orders.edit', ['order' => $order]) }}">
                            <flux:icon.pencil-square class="size-5 hover:text-blue-600" />
                        </a>
                    </td>
                @endif
                @if($showDelete)
                    <td class="px-0.5">
                        <form method="POST" action="{{ route('orders.destroy', ['order' => $order]) }}" class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <flux:icon.x-circle class="size-5 hover:text-red-600" />
                            </button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        <!-- 'pdf_receipt','cancel_reason', -->
    </table>
</div>
