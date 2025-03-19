<?php

namespace App\Http\Controllers\v1\Home;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index(){

        return view('home.index');
    }

    public function paymentSuccess(){

        return view('home.succesful');
    }

    public function paymentFailed(){

        return view('home.failed');
    }




    public function initializePayment(Request $request)
    {
        $validated =  $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'amount' => 'required|numeric',
            'location' => 'required|string',
        ]);

        $tx_ref = uniqid('trx_');  // Unique transaction reference
        $flutterwaveSecretKey = env('FLW_SECRET_KEY');


        // Save payment data to the database
        $payment = Transaction::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'location' => $validated['location'],
            'amount' => $validated['amount'] / 100,
            'currency' => 'NGN',
            'status' => 'pending',
            'payment_method' => 'flutterwave',
            'reference' => $tx_ref
        ]);

        return response()->json([
            'status' => 'success',
            'tx_ref' => $tx_ref,
        ]);
    }

    public function handlePaymentSuccess(Request $request)
    {
        $transaction_id = $request->query('transaction_id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('FLW_SECRET_KEY'),
        ])->get("https://api.flutterwave.com/v3/transactions/{$transaction_id}/verify");

        $data = $response->json();

        Log::info("Log all", ['transaction' => $data]);

        if ($data['status'] === 'success' && $data['data']['status'] === 'successful') {
            $reference = $data['data']['tx_ref'];

            $payment = Transaction::where('reference', $reference)->first();

            $generateTicketId = Transaction::generateTicketId();

            if ($payment) {
                $payment->update([
                    'status' => 'successful',
                    'ticket_id' => $generateTicketId,
                    'seat_number' => $generateTicketId,
                    'Bus Type'  => "Toyota Hiace"
                ]);
                $this->sendConfirmationEmail($payment);

                return redirect()->route('payment.success')->with('success', 'Payment completed successfully.');
            } else {
                return redirect()->route('payment.failed')->with('error', 'Payment record not found.');
            }
        } else {
            return redirect()->route('payment.failed')->with('error', 'Payment verification failed.');
        }
    }



    private function sendConfirmationEmail($payment)
    {
        $details = [
            'subject' => "Confirmation of Travel Booking - Ticket ID: {$payment->ticket_id}",
            'email' => $payment->email,
            'name' => $payment->name,
            'ticket_id' => $payment->ticket_id,
            'origin' => "Ibadan",
            'destination' => $payment->location,
            'departure_date' => now()->format('Y-m-d'),
            'departure_time' => now()->format('H:i A'),
            'bus_type' => $payment->car_type,
            'seat_number' => $payment->seat_number
        ];

        Mail::send('email.confirmation', $details, function ($message) use ($details) {
            $message->to($details['email'])
                ->subject($details['subject']);
        });
    }



}
