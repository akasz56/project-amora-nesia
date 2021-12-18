<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $this->initPaymentGateway();
        $statusCode = null;

        $paymentNotification = new \Midtrans\Notification();
        $order = Order::where('orderUUID', '=', $paymentNotification->order_id)->first();

        if ($order->isPaid()) {
            return response(['message' => 'The order has been paid before'], 422);
        }

        $transaction = $paymentNotification->transaction_status;
        $type = $paymentNotification->payment_type;
        $orderId = $paymentNotification->order_id;
        $fraud = $paymentNotification->fraud_status;

        $vaNumber = null;
        $vendorName = null;
        if (!empty($paymentNotification->va_numbers[0])) {
            $vaNumber = $paymentNotification->va_numbers[0]->va_number;
            $vendorName = $paymentNotification->va_numbers[0]->bank;
        }

        $paymentStatus = null;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $paymentStatus = 'challenge';
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $paymentStatus = 'success';
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $paymentStatus = 'settlement';
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $paymentStatus = 'pending';
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = 'deny';
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $paymentStatus = 'expire';
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = 'cancel';
        }

        // $payment = Payment::create([
        $payment = new Payment([
            'order_id' => $order->id,
            'number' => 00110011,
            'amount' => $paymentNotification->gross_amount,
            'method' => 'midtrans',
            'status' => $paymentStatus,
            'token' => $paymentNotification->transaction_id,
            'payloads' => $payload,
            'payment_type' => $paymentNotification->payment_type,
            'va_number' => $vaNumber,
            'vendor_name' => $vendorName,
            'biller_code' => $paymentNotification->biller_code,
            'bill_key' => $paymentNotification->bill_key,
        ]);


        if ($paymentStatus && $payment) {
            dump("bayar");
            if ($payment->status == 'success' || $payment->status == 'settlement') {
                $order->status = 2;
                $order->save();
            }
        }

        $message = 'Payment status is : ' . $paymentStatus;

        $response = [
            'code' => 200,
            'message' => $message,
        ];

        return response($response, 200);
    }

    public function completed(Request $request)
    {
        $code = $request->query('order_id');
        $order = Order::where('orderUUID', $code)->firstOrFail();

        if (!$order->isPaid()) {
            return redirect('payments/failed?order_id=' . $code);
        }

        return redirect()->route('order.actions', ['uuid' => $order->orderUUID])->with('success', "Thank you for completing the payment process!");
    }

    public function unfinish(Request $request)
    {
        $code = $request->query('order_id');
        $order = Order::where('orderUUID', $code)->firstOrFail();

        return redirect()->route('order.actions', ['uuid' => $order->orderUUID])->with('danger', "Sorry, we couldn't process your payment.");
    }

    public function failed(Request $request)
    {
        $code = $request->query('order_id');
        $order = Order::where('orderUUID', $code)->firstOrFail();

        return redirect()->route('order.actions', ['uuid' => $order->orderUUID])->with('danger', "Sorry, we couldn't process your payment.");
    }
}
