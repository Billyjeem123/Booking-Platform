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

    public function paymentSuccess($ticket_id){

        $tickets = Transaction::where('ticket_id', $ticket_id)->first();

        if (!$tickets) {
            return redirect()->route('home')->with('error', 'Invalid Ticket ID.');
        }

        $ticket = $tickets->ticket_id;

        return view('home.succesful', compact('ticket'));
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
            'phone' => $validated['phone'],
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

                try {
                    $this->sendConfirmationEmail($payment);
                } catch (\Exception $e) {
                    Log::error('Failed to send confirmation email', [
                        'error' => $e->getMessage(),
                        'payment_id' => $payment->id,
                    ]);
                }

                return redirect()->route('payment.success', ['ticket_id' => $generateTicketId])
                    ->with('success', 'Payment completed successfully.');

            } else {
                return redirect()->route('payment.failed')->with('error', 'Payment record not found.');
            }
        }
        else {
            // Log the reason why the payment failed
            $errorMessage = $data['message'] ?? 'Unknown error';
            $errorStatus = $data['data']['status'] ?? 'Unknown status';
            $reference = $data['data']['tx_ref'] ?? null;

            // Log the error to the database if a payment reference exists
            if ($reference) {
                Transaction::where('reference', $reference)->update([
                    'status' => 'failed',
                    'failure_reason' => $errorMessage,
                ]);
            }

            Log::error("Payment verification failed", [
                'message' => $errorMessage,
                'status' => $errorStatus,
                'transaction_id' => $transaction_id,
                'reference' => $reference
            ]);

            return redirect()->route('payment.failed')->with('error', 'Payment verification failed. Reason: ' . $errorMessage);
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
