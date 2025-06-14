@extends('layout')

@section('header-title', 'Pay with Paypal')

@section('main')

@php
    $formData = [
        'action' => route('funds.store'),
        'buttonText' => 'Pay with Paypal',
        'inputs' => [
            ['name' => 'email_address', 'type' => 'email', 'placeholder' => 'Email address'],
            ['name' => 'payment_method', 'type' => 'hidden', 'value' => 'paypal'], 
        
        ],
    ];
@endphp

@include('payments.partials.payment_form', $formData)

@endsection