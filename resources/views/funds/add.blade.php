@extends('layout')

@section('header-title', 'Add Funds')

@section('main')
    <h1>Add Funds</h1>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <p>Select a payment method:</p>

    <div class="flex gap-4">
        <x-hyperlink-text-button text="Add Funds with Visa" :href="route('pay.visa.form')" type="primary" />

        <x-hyperlink-text-button text="Add Funds with PayPal" :href="route('pay.paypal.form')" type="info" />

        <x-hyperlink-text-button text="Add Funds with MBWay" :href="route('pay.mbway.form')" type="success" />
    </div>
@endsection