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
        
        return view('statistics.index');
    }
}
