@extends('layout')

@section('title', 'Pay with Paypal')

@section('content')

@php
    $formData = [
        'action' => route('pay.paypal'),
        'buttonText' => 'Pay with Paypal',
        'inputs' => [
            ['name' => 'email_address', 'type' => 'email', 'placeholder' => 'Email address'],
        ],
    ];
@endphp

@include('payments.partials.payment_form', $formData)

@endsection