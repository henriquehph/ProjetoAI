@extends('layout')

@section('title', 'Pay with MBway')

@section('content')

@php
    $formData = [
        'action' => route('pay.mbway'),
        'buttonText' => 'Pay with MBway',
        'inputs' => [
            ['name' => 'phone_number', 'type' => 'text', 'placeholder' => '9-digit phone number starting with 9'],
        ],
    ];
@endphp

@include('payments.partials.payment_form', $formData)

@endsection
