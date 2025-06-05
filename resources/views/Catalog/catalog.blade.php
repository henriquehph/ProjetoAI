@extends('layouts.Layout')

@section('title', 'Catalog')
@section('main')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="./app.css" rel="stylesWheet">
        <title>Catalog of Products</title>
    </head>
    <body>
        <div class="container bg-[rgb(193, 214, 243)] cen p-4 border-2 border-blue-500  mx-auto my-4">
            <h1 class="text-3xl text-center text-white-500">Catalog of Products</h1>
            <p class="text-center ">Welcome to the product catalog. Here you can find a variety of items.</p>
            @section('header-title', 'List of courses')
            <h2 class="text-center text-lg text-blue-800">List of items</h2>
            <nav class="flex justify-between items-center mb-4">
                <ul class="flex space">
                </ul>
            </nav>
            <main class="flex flex-col mx-auto container max-w-6xl">
                <div class="space-y-4 p-2 w-full max-w-[10rem]">
                    <h2 class="text-2xl">Filters</h2>
                    <h3 class="text-xl">Categories</h3>
                    <div id="filters-container"></div>
                </div>
            </main>
                @foreach ($allProducts as $product) <!--Var name is right , this part is also right-->
                
                @endforeach
        </div>
    </body>
</html>