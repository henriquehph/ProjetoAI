<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Operation;
use App\Models\User;



class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * maybe view pra user e desuser :)
     */
  
    public function index(Request $request)
    {
        // Display a listing of the resource.   
        $statistics = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_operations' => Operation::count(),
        ];

        

        $request->validate([
            'filter' => 'nullable|string|in:Cum,Month,Year', // Validate the filter parameter
        ]);
        $filter = $request->input('filter', 'Total'); // Default to 'Cum' if no filter is provided
        
        if ($filter == 'Month') {
            $statistics['total_users'] = User::whereMonth('created_at', now()->month)->count();
            $statistics['total_products'] = Product::whereMonth('created_at', now()->month)->count();
            $statistics['total_orders'] = Order::whereMonth('created_at', now()->month)->count();
            $statistics['total_operations'] = Operation::whereMonth('created_at', now()->month)->count();
        } elseif ($filter == 'Year') {
            $statistics['total_users'] = User::whereYear('created_at', now()->year)->count();
            $statistics['total_products'] = Product::whereYear('created_at', now()->year)->count();
            $statistics['total_orders'] = Order::whereYear('created_at', now()->year)->count();
            $statistics['total_operations'] = Operation::whereYear('created_at', now()->year)->count();
        }
       /*Im deciding to not do a modela and simply do this all here cause i dont really access the db, but im probably being bad */

        if(Auth::user()->type=="Board") { // If admin, show general statistics
            return view('statistics.index', [
                'str1' => 'Total Users Registered',
                'resp1' => $statistics['total_users'] ,
                'str2' => 'Total Products Bought',
                'resp2' => $statistics['total_products'],
                'str3' => 'Total Orders Placed',
                'resp3' => $statistics['total_orders'],
                'str4' => 'Total Operations Performed',
                'resp4' => $statistics['total_operations'],
                'judged' => "Grocery Club Organization",
                'filter' => 'Cum', // to show the general statistics
            ]);
        } else {
            return view('statistics.index', [ //else, give compared statistics
                'str1' => 'Most Expensive Orders',
                'resp1' => Auth::user()->most_expensive_order . ' €',
                'str2' => 'Cheapest order',
                'resp2' => Auth::user()->cheapest_order . ' €',
                'str3' => 'Average money spent on order',
                'resp3' => Auth::user()->average_money_spent_on_order . ' €',
                'str4' => 'Average products per order',
                'resp4' => Auth::user()->average_products_per_order . ' items',
                'filter' => 'Cum',
                'judged' => Auth::user()->name, // to show the compared statistics
            ]);
        }
        
    }

    
}
