<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Payment;

class PaymentController extends Controller
{
    public function payWithVisa(Request $request)
    {
        $request->validate([
            'card_number' => ['required', 'digits:16', 'not_regex:/^0/'],
            'cvc_code' => ['required', 'digits:3', 'not_regex:/^0/'],
        ]);

        $card_number = $request->input('card_number');
        $cvc_code = $request->input('cvc_code');

        if (Payment::payWithVisa($card_number, $cvc_code)) {
            return back()->with('success', 'Visa payment successful!');
        }

        return back()->withErrors(['payment' => 'Visa payment failed.']);
    }

    public function payWithPaypal(Request $request)
    {
        $request->validate([
            'email_address' => ['required', 'email'],
        ]);

        $email = $request->input('email_address');

        if (Payment::payWithPaypal($email)) {
            return back()->with('success', 'Paypal payment successful!');
        }

        return back()->withErrors(['payment' => 'Paypal payment failed.']);
    }

    public function payWithMBway(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'digits:9', 'regex:/^9/'],
        ]);

        $phone_number = $request->input('phone_number');

        if (Payment::payWithMBway($phone_number)) {
            return back()->with('success', 'MBway payment successful!');
        }

        return back()->withErrors(['payment' => 'MBway payment failed.']);
    }
}

