<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    
    public function Pcheckout()
    {
        return view("checkout");
    }

    public function Payment(Request $request)
    {
        \Stripe\Stripe::setApikey('sk_test_51MpgfjCoRbwLjXYjdSkK3F86JPfwJoIirgoGNYUtKnURlBHISaaWhEgP5iN7zm52hnUHertwT7KwpiH83gfjbKXW0064Ntqc2u');

        $prodcutname = $request->productname;
        $total = $request->total * 100;
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                'price_data' => [
                    'currency' => 'BRL',
                    'product_data' => [
                        'name' => $prodcutname,
                    ],
                    'unit_amount' => $total
                ],
                'quantity' => 1
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('success'),
        'cancel_url' => route('checkout')
    ]);

    return redirect()->away($session->url);

    }

    public function success()
    {
        return "Thank you for the payment";
    }
}
