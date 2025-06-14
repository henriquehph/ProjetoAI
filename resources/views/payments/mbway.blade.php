@extends('layout')

@section('header-title', 'Pay with MBway')

@section('main')

@php
    $formData = [
        'action' => route('funds.store'),
        'buttonText' => 'Pay with MBway',
        'inputs' => [
            ['name' => 'phone_number', 'type' => 'text', 'placeholder' => '9-digit phone number starting with 9'],
            ['name' => 'payment_method', 'type' => 'hidden', 'value' => 'mbway'], 
        ],
    ];
@endphp

@include('payments.partials.payment_form', $formData)

@endsection