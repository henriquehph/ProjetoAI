<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
        return view('statistics.index', compact('statistics'));
    }
}
