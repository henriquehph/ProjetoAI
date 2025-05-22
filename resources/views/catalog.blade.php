<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Styles -->
    <link href="./output.css" rel="stylesheet">
    <title>Catalog of Products</title>
</head>
<body>
    <table>
        <thead><!--deve ser ma ideia fazer isto primeiro com base html pra depois fazer com tailwind na msm..-->
            <tr>
            <th>Product</th>
            <th>Category</th>
            <th>Price</th>
            <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Product as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->photo }}</td>
                <!--<td>{{ $product->type }}</td>-->
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td> <!--theory says its right-->
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>