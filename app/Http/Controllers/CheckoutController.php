<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Stripe::setApiKey(config('cashier.secret'));
        $checkoutSession = Session::create([
            'mode' => 'subscription',
            'customer' => $request->user()->stripe_id,
            'line_items' => [[
                'price' => 'price_1RG31rFY2rarmKfjlDnDqfSh',
                'quantity' => 1,
            ]],
            'success_url' => 'http://localhost:5173/success',
            'cancel_url' => 'http://localhost:5173/cancel',
        ]);
    
        return response()->json([
            'sessionId' => $checkoutSession->id,
        ]);
    }
}
