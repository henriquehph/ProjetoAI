<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

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

        return view(
            'products.index',
            compact('products', 'filterByName', 'filterPrice', 'filterByCategories', 'filterByDiscount', 'categories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $newProduct = new Product();
        return view('products.create')->with('product', $newProduct);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {

        $data = $request->validated();
        //dd($request->all());
        $category = Category::where('name', $request->input('category_name'))->first();

        if (!$category) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['category_name' => 'The selected category does not exist.']);
        }

        // Set the category_id in data so it can be saved in the product
        $data['category_id'] = $category->id;

        // Handle photo upload if file is present
        if ($request->hasFile('photo_file')) {
            $path = $request->file('photo_file')->store('photos', 'public');

            //dd($path); // debug
            $data['photo'] = $path; // save relative path in 'photo' field
        }

        Product::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function showCase(Product $product)
    {
        return view('products.showcase');
    }

    public function show(Product $product)
    {
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, Product $product)
    {
        $data = $request->validated();
        //dd($request->all());
        $category = Category::where('name', $request->input('category_name'))->first();

        if (!$category) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['category_name' => 'The selected category does not exist.']);
        }

        // Set the category_id in data so it can be saved in the product
        $data['category_id'] = $category->id;


        if ($request->hasFile('photo_file')) {
            // Delete old photo if exists
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            // Store new photo
            $path = $request->file('photo_file')->store('photos', 'public');
            $data['photo'] = $path;
        }

        if ($request->input('delete_photo') == '1') {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $data['photo'] = null;
        }

        //dd($data);
        $product->update($data);

        return redirect()->route('products.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->deleted_at) {
            $product->deleted_at = null;
            $product->save();
            return redirect()->route('products.index')->with('success', 'Category restored successfully.');
        }
        if ($product->items_order()->count() == 0) {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Category deleted successfully.');
        }

        $product->deleted_at = now();
        $product->save();

        return redirect()->route('products.index')->with('error', 'Category cannot be fully deleted because it has associated products.');
    }

    // Emite um alerta caso o stock de algum produto chegar ao stock_lower_limit
    public function alert($id)
    {
        $product = Product::find($id);

        if ($product->isStockLow()) {
            $alertType = 'danger';
            $url = route('products.show', $product->id);
            $alertMsg = "Stock at lower limit <a href='$url'><u>Stock: {$product->stock}</u></a> Lower Limit: ({$product->stock_lower_limit})";
            return redirect()->back()
                ->with('alert-type', $alertType)
                ->with('alert-msg', $alertMsg);
        }
    }
}
