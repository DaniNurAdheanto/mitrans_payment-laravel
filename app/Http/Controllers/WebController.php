<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function payment(Request $request)

    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-pbhE0ZoHCFn0F9DGZk6vbAaM';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),

            'item_details' => array(
                [
                    'id' => 'kue1',
                    'price' => '55000',
                    'quantity' => '1',
                    'name' => 'Kue Nastar'
                ], [
                    'id' => 'kue2',
                    'price' => '65000',
                    'quantity' => '1',
                    'name' => 'Kue Nastar Keju'
                ],
            ),

            'customer_details' => array(
                'first_name' => $request->get('uname'),
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('number'),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment', ['snap_token' => $snapToken]);
    }

    public function payment_post(Request $request)
    {
        return $request;
    }
}
