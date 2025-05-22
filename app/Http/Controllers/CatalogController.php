<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;



class CatalogController extends Controller
{
    //mostra pagina catalogo
   
    public function catalogPage(){
        $allProducts = Product::all(); //all entries
        return view('catalog', ['Product' => $allProducts]);
    }
}
