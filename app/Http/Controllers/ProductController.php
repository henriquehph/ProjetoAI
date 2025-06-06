<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filterByName = $request->query('name');
        $filterPrice = $request->query('price');
        $filterByCategories = $request->query('category');
        $filterByDiscount = $request->query('discount');

        $categories = Category::where('id', '<=', 10)->pluck('name', 'id');

        $productsQuery = Product::query();


        if ($filterByName !== null) {
            $productsQuery->where('name', 'LIKE', '%' . $filterByName . '%');
        }
        if ($filterPrice === 'asc' || $filterPrice === 'desc') {
            $productsQuery->orderBy('price', $filterPrice);
        }
        if ($filterByCategories !== null) {
            $productsQuery->where('category_id', $filterByCategories);
        }
        if ($filterByDiscount !== null) {
            $productsQuery->where('discount', $filterByDiscount);
        }

        $products = $productsQuery
            ->with('category')
            ->orderBy('name')
            ->orderBy('category_id')
            ->paginate(20)
            ->withQueryString();

        return view('products.index',
            compact('products', 'filterByName', 'filterPrice', 'filterByCategories', 'filterByDiscount','categories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    // Emite um alerta caso o stock de algum produto chegar ao stock_lower_limit
    public function alert($id)
    {
        $product = Product::find($id);

        if ($product->isStockLow())
        {
            $alertType = 'danger';
            $url = route('products.show', $product->id);
            $alertMsg = "Stock at lower limit <a href='$url'><u>Stock: {$product->stock}</u></a> Lower Limit: ({$product->stock_lower_limit})";
            return redirect()->back()
                ->with('alert-type', $alertType)
                ->with('alert-msg', $alertMsg);
        }
    }
}
