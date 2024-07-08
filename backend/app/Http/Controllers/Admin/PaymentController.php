<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        $payments = PaymentResource::collection($payments);
        return view('setting.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }
    public function showPaymentForm(Request $request)
    {
        $clientSecret = $this->createPaymentIntent(50 * 100); // Example amount in cents
        return view('formPayment.payment.', compact('clientSecret'));
    }

    public function processPayment(Request $request)
    {
        // This method can be used to update the payment status in your database
        // You can use the Stripe webhook for more secure and reliable updates
        return response()->json(['success' => true]);
    }
    private function createPaymentIntent($amount)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        return $paymentIntent->client_secret;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        Payment::store($request);
        // return redirect()->route('admin.payment.index')->with('success', 'Payment method added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
