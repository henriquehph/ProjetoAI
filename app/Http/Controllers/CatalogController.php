<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;

class CatalogController extends Controller
{
    //mostra pagina catalogo
   
    public function catalogPage(){ /*for some reason its not working!*/
        $allProducts = Product::all(); //all entries of db
        //check if there are products
        if ($allProducts->isEmpty()) {
            return view('catalog')->with('message', 'No products available'); //if no products, show message
        }
        //if there are products, show them

        //return view('catalog')->with('Produtos', $allProducts); Pass all products to the view with the name 'allProducts'
        return view('catalog', compact('allProducts')); // same as above but more elegant(supposed to be more elegant)
    }
}
