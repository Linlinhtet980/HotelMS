<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\StripeClient;

class StripePaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout.checkout');
    }

    public function checkoutProcess(Request $request)
    {
        $Stripe = new StripeClient(config('services.stripe.secret'));

        $productName = $request->input('product_name', 'Hotel Room Booking');
        $price = $request->input('price', 0);
        $quantity = $request->input('quantity', 1);

        $session = $Stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd', // ဒေါ်လာနဲ့ ရှင်းမယ်
                    'product_data' => [
                        'name' => $productName, // ဘာအတွက် ရှင်းတာလဲ (ဥပမာ - Deluxe Room)
                    ],
                    'unit_amount' => $price * 100, // ပြား (cents) နဲ့တွက်တဲ့အတွက် 100 နဲ့ မြှောက်ရတယ်
                ],
                'quantity' => $quantity,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'), // အောင်မြင်ရင် ဒီ route ကို ပြန်လာမယ်
            'cancel_url' => route('stripe.cancel'),   // Cancel လုပ်ရင် ဒီ route ကို ပြန်လာမယ်
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        // ဒီနေရာမှာ Database ထဲက payment_status ကို 'paid' လို့ ပြောင်းတဲ့ Code ရေးရပါမယ်
        return view('checkout.checksuccess');
    }

    public function cancel()
    {
        return view('checkout.checkcancel');
    }
}
