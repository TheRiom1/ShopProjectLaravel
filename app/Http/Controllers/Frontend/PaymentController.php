<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderPaymentUpdateEvent;
use App\Events\OrderPlacedNotificationEvent;
use App\Events\RTOrderPlacedNotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Razorpay\Api\Api as RazorpayApi ;
use Illuminate\Support\Facades\Redirect;


class PaymentController extends Controller
{
    function index(): View
    {
        if (!session()->has('delivery_fee') || !session()->has('address')) {
            throw ValidationException::withMessages(['Something went wrong']);
        }

        $subtotal = cartTotal();
        $delivery = session()->get('delivery_fee') ?? 0;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $grandTotal = grandCartTotal($delivery);
        return view('frontend.pages.payment', compact(
            'subtotal',
            'delivery',
            'discount',
            'grandTotal'
        ));
    }
    function paymentSuccess() : View {
        return view('frontend.pages.payment-success');
    }


    function makePayment(Request $request, OrderService $orderService)
    {
        $request->validate([
            'payment_gateway' => ['required', 'string', 'in:paypal']
        ]);

        /** Create Order */
        if ($orderService->createOrder()) {
            // redirect user to the payment host
            $orderService->clearSession();
            return $this->paymentSuccess();

        }

    }

}
