@extends('layouts.Layout')

@section('title', 'Update course "' . $allProducts->name . '"')

@section('main')

<form method="POST" action="{{ route('courses.update', ['course' => $course]) }}">
    @csrf
    @method('PUT')
    @include('courses.shared.fields')
    <div>
        <button type="submit" name="ok">Save Product</button>
    </div>
</form>

@endsection