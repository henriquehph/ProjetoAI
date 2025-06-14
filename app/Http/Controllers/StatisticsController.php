<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * maybe view pra user e desuser :)
     */
    public function index()
    {
        // Display a listing of the resource.   
        $statistics = [
            'total_users' => \App\Models\User::count(),
            'total_products' => \App\Models\Product::count(),
            'total_orders' => \App\Models\Order::count(),
            'total_operations' => \App\Models\Operation::count(),
        ];

        $Comparedstatistics = [
            'Most_expensive_order' => \App\Models\Order::orderBy('total', 'desc')->first()->value('total') ?? 0,
            'Cheapest_order' => \App\Models\Order::orderBy('total', 'asc')->first()->value('total') ?? 0, 
            'Average_money_spent_on_order' => \App\Models\Order::average('total') ?? 0,
            'Average_products_per_order' => \App\Models\Order::average('total_items') ?? 0,
        ];
        if(Auth::user()->type) { // If admin, show general statistics
            return view('statistics.index', [
                'str1' => 'Total users',
                'resp1' => $statistics['total_users'],
                'str2' => 'Total products',
                'resp2' => $statistics['total_products'],
                'str3' => 'Total orders',
                'resp3' => $statistics['total_orders'],
                'str4' => 'Total operations',
                'resp4' => $statistics['total_operations'],
                'judged' => "Grocery Club Organization",
            ]);
        } else {
            return view('statistics.index', [ //else, give compared statistics
                'str1' => 'Most expensive order',
                'resp1' => $Comparedstatistics['Most_expensive_order'],
                'str2' => 'Cheapest order',
                'resp2' => $Comparedstatistics['Cheapest_order'],
                'str3' => 'Average money spent on order',
                'resp3' => $Comparedstatistics['Average_money_spent_on_order'],
                'str4' => 'Average products per order',
                'resp4' => $Comparedstatistics['Average_products_per_order'],

                'judged' => Auth::user()->name, // to show the compared statistics
            ]);
        }
        
    }
}
