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

        $orders = $ordersQuery->paginate(20)->withQueryString();

        return view('orders.index', compact('orders', 'status', 'filterPrice', 'filterDate'));
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
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
