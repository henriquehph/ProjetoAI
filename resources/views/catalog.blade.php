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
        <div class="container">
            @section('header-title', 'List of courses')
            <h2 class="text-center text-lg text-blue-800">List of items</h2>

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Photo</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allProducts as $product) <!--Var name is right , this part is also right-->
                        <tr>
                            <td>{{ $product->name }}</td>
                            <!--<td><img src="{{ $product->photo }}" alt="{{ $product->name }}" /></td>-->
                            <td><img src="{{ $product->photoFullUrl }}" alt="{{ $product->name }}" style="width: 45px; height: 45px; border-radius: 8px;"></td><!-- Mostrar fotos através da função -->
                            <td>{{ $product->category_id }}</td> <!-- Alterei para category_id -->
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</body>
</html>
