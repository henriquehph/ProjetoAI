@extends('layout')

@section('header-title', 'Pay with Visa')

@section('main')

@php
    $formData = [
        'action' => route('funds.store'),
        'buttonText' => 'Pay with Visa',
        'inputs' => [
            ['name' => 'card_number', 'type' => 'text', 'placeholder' => '16-digit card number'],
            ['name' => 'cvc_code', 'type' => 'text', 'placeholder' => '3-digit CVC code'],
            ['name' => 'payment_method', 'type' => 'hidden', 'value' => 'visa'], 
        ],
    ];
@endphp

@include('payments.partials.payment_form', $formData)

@endsection