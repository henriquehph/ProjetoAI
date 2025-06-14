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

        $request->validate([
            'filter' => 'nullable|string|in:Cum,Month,Year', // Validate the filter parameter
        ]);
        $filter = $request->input('filter', 'Total'); // Default to 'Cum' if no filter is provided
        
        // Get the authenticated user
        // Get the authenticated user
        /*Im deciding to not do a modela and simply do this all here cause i dont really access the db, but im probably being bad */

        if(Auth::user()->type=="Board") { // If admin, show general statistics
            return view('statistics.index', [
                'str1' => 'Total Users Registered',
                'resp1' => User::count(),
                'str2' => 'Total Products Bought',
                'resp2' => Product::count(),
                'str3' => 'Total Orders Placed',
                'resp3' => Order::count(),
                'str4' => 'Total Operations Performed',
                'resp4' => Operation::count(),
                'judged' => "Grocery Club Organization",
                'filter' => $filter, // to show the general statistics
            ]);
        } else {
            return view('statistics.index', [ //else, give compared statistics
                'str1' => 'Most Expensive Orders',
                'resp1' => $userOrders = Order::getMostExpensiveOrders($filter, Auth::user()->id),
                'str2' => 'Cheapest order',
                'resp2' => Order::getCheapestOrders($filter, Auth::user()->id),
                'str3' => 'Average money spent on order',
                'resp3' => Order::getAverageMoneySpentOnOrder($filter, Auth::user()->id) . ' €',
                'str4' => 'Average products per order',
                'resp4' => Order::getAverageProductsPerOrder($filter, Auth::user()->id) . ' items',
                'filter' => 'Cum',
                'judged' => Auth::user()->name, // to show the compared statistics
            ]);
        }
        
    }
    

    
}
