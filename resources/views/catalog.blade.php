@extends('layouts.main')

@section('header-title', 'Introduction')

@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     Styles 
    <link href="./app.css" rel="stylesheet">
    <title>Catalog of Products</title>
</head>
<x-app-layout>
    <div class="container">
        <h2>Add Funds to Your Card</h2>
        @foreach ($Product as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->photo }}</td>
                <td>{{ $product->type }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>
            </tr>
        @endforeach
    </div>
</x-app-layout>
@endsection
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     Styles 
    <link href="./app.css" rel="stylesheet">
    <title>Catalog of Products</title>
</head>

<body>
    <table>
        <thead>deve ser ma ideia fazer isto primeiro com base html pra depois fazer com tailwind na msm.
            <tr>
            <th>Product</th>
            <th>Photo</th>
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
                <td>{{ $product->type }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td> <!--theory says its right (its not)
            </tr>
        @endforeach
        </tbody>
    </table>
</body>

</html>