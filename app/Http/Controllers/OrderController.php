<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        $filterPrice = $request->query('price');
        $filterDate = $request->query('date');
        $filterId = $request->query('member_id');

        $ordersQuery = Order::query();

        if ($status !== 'all') {
            $ordersQuery->where('status', $status);
        }

        if ($filterDate === 'today') {
            $ordersQuery->whereDate('created_at', now()->toDateString());
        }

        if ($filterDate === 'recent') {
            $ordersQuery->orderBy('created_at', 'desc');
        } elseif ($filterDate === 'oldest') {
            $ordersQuery->orderBy('created_at', 'asc');
        }

        if ($filterPrice === 'asc' || $filterPrice === 'desc') {
            $ordersQuery->orderBy('total', $filterPrice);
        }

        if (!empty($filterId)) {
            $ordersQuery->where('member_id', $filterId);
        }

        $orders = $ordersQuery->paginate(20)->withQueryString();

        return view('orders.index', compact('orders', 'status', 'filterPrice', 'filterDate', 'filterId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function cancel(Request $request, Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        // Validate and update the order details
        $orderId = $request->input('order_id'); // Assuming you get the order ID from the request
        $order = Order::findOrFail($orderId);
        $order->update($request->only('status', 'total'));

        // Optionally, handle any additional logic such as sending notifications

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function cancelOrder(Request $request)
    {
        $orderId = $request->input('order_id'); // Assuming you get the order ID from the request
        $order = Order::findOrFail($orderId);
        $order->update(['status' => 'canceled']);

        return redirect()->route('orders.index')->with('success', 'Order canceled successfully.');
    }

       

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
