<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function checkout(Request $request)
    {
        $user = $request->user();

        $checkout = $user->newSubscription('Premium Subscription', 'price_1RG31rFY2rarmKfjlDnDqfSh')
            ->checkout([
                'success_url' => 'http://localhost:5173/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost:5173/cancel',
            ]);

        return response()->json(['url' => $checkout->url]);
    }

    
    public function isSubscribed(Request $request):JsonResponse
    {
        $user = $request->user();
        if($user->subscribed('Premium Subscription')){
            return response()->json(['subscription'=>$user->subscription('Premium Subscription')->type],200);
        }elseif($user->subscribed('default')){
            return response()->json(['subscription'=>$user->subscription('default')->type],200);
        }
        return response()->json(['message' => 'you are not subscribed'], 403);
        //return response()->json(['message' => 'not subscribed'],403);

    }

    public function cancel(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->subscription('default')->cancel();

        return response()->json(['message' => 'your subscription has been canceled']);
    }
}
