@extends('layout')

@section('header-title', 'Add Funds')

@section('main')
    <h1>Add Funds</h1>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <p>Select a payment method:</p>

    <ul>
        <li><a href="{{ route('pay.visa.form') }}">Add Funds with Visa</a></li>
        <li><a href="{{ route('pay.paypal.form') }}">Add Funds with PayPal</a></li>
        <li><a href="{{ route('pay.mbway.form') }}">Add Funds with MBWay</a></li>
    </ul>
@endsection