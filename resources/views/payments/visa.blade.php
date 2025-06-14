@extends('layouts')

@section('title', 'Pay with Visa')

@section('content')

@php
    $formData = [
        'action' => route('pay.visa'),
        'buttonText' => 'Pay with Visa',
        'inputs' => [
            ['name' => 'card_number', 'type' => 'text', 'placeholder' => '16-digit card number'],
            ['name' => 'cvc_code', 'type' => 'text', 'placeholder' => '3-digit CVC code'],
        ],
    ];
@endphp

@include('payments.partials.payment_form', $formData)

@endsection