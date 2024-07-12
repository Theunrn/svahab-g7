<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Admin: get all payments
            $payments = Payment::latest()->get();
        } else {
            // Owner: get payments created by the owner
            $payments = Payment::where('owner_id', Auth::id())->latest()->get();
            
        }

        $payments = PaymentResource::collection($payments);
        return view('setting.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a payment intent.
     */
    public function showPaymentForm(Request $request)
    {
        $clientSecret = $this->createPaymentIntent($request);
        return view('setting.payment.form', compact('clientSecret'));
    }

    /**
     * Show the form for creating a payment intent for monthly payments.
     */
    public function showPaymentFormMonth(Request $request)
    {
        $clientSecret = $this->createPaymentIntent($request);
        return view('setting.payment.payMonth', compact('clientSecret'));
    }

    /**
     * Create a payment intent with Stripe.
     */
    private function createPaymentIntent($request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amount = $request->input('amount') ?? 50;
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount * 100,
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
        // Validate incoming request
        $validatedData = $request->validated();

        // Store payment details
        $payment = new Payment();
        $payment->amount = $validatedData['amount'];
        // Add other fields as needed
        $payment->save();

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.payments.index')->with('success', 'Payment added successfully.');
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
