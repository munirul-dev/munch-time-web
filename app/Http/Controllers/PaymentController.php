<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        try {
            $user = Auth::user();
            $secretKey = config('app.secret_key');
            $menuId = $request->menuId;
            $studentId = $request->studentId;
            $menu = Menu::find($menuId);
            $menuQuantity = $request->quantity;
            $amount = $menuQuantity * $menu->price;
            $detail = $menu->name;

            $reservation = Reservation::create([
                'user_id' => $user->id,
                'student_id' => $studentId,
                'menu_id' => $menuId,
                'quantity' => $menuQuantity,
                'date' => $request->date,
                'amount_paid' => $amount,
                'description' => $menu->name,
                'status' => 0
            ]);

            $orderId = 'TRX-' . $reservation->id . '-' . date('YmdHis'); // TRX-[USER_ID]-[SERVICE_ID]-[BOOKING_ID]-[DATE]
            $hashed_string = hash_hmac('SHA256', $secretKey . $detail . $amount . $orderId, $secretKey);

            Payment::create([
                'user_id' => $user->id,
                'reservation_id' => $reservation->id,
                'order_id' => $orderId,
                'amount' => $amount,
                'status' => 0
            ]);

            return response()->json([
                'success' => true,
                'data' => route('payment.process', [
                    'reservation_id' => $reservation->id,
                    'user_id' => $user->id,
                    'detail' => $detail,
                    'amount' => $amount,
                    'order_id' => $orderId,
                    'hash' => $hashed_string
                ])
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function process(Request $request)
    {
        $paymentUrl = config('app.payment_url');
        $merchantId = config('app.merchant_id');
        $secretKey = config('app.secret_key');

        $user = User::find($request->user_id);
        $detail = $request->detail;
        $amount = $request->amount;
        $orderId = $request->order_id;
        $hashed_string = $request->hash;

        return view('payment.process', [
            'action' => $paymentUrl . '/' . $merchantId,
            'merchant_id' => $merchantId,
            'secretkey' => $secretKey,
            'detail' => $detail,
            'amount' => $amount,
            'order_id' => $orderId,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->mobile_phone_no,
            'hash' => $hashed_string
        ]);
    }

    public function return(Request $request)
    {
        try {
            $secretKey = config('app.secret_key');
            $hash = hash_hmac('SHA256', $secretKey . '?name=' . urlencode($request->name) . '&email=' . urlencode($request->email) . '&phone=' . urlencode($request->phone) . '&amount=' . urlencode($request->amount) . '&order_id=' . urlencode($request->order_id) . '&txn_ref=' . urlencode($request->txn_ref) . '&txn_type=' . urlencode($request->txn_type) . '&txn_status=' . urlencode($request->txn_status) . '&txn_msg=' . urlencode($request->txn_msg) . '&hashed_value=[HASH]', $secretKey);
            // ?name=[NAME]&email=[EMAIL]&phone=[PHONE]&amount=[AMOUNT]&order_id=[ORDER_ID]&txn_ref=[TXN_REF]&txn_type=[TXN_TYPE]&txn_status=[TXN_STATUS]&txn_msg=[MSG]&hashed_value=[HASH]

            $data = $request->all();
            $payment = Payment::where('order_id', $data['order_id'])->first();
            $data['action_back'] = (!empty(env('PWA_URL')) ? env('PWA_URL') : env('APP_URL')) . '/pages/reservations/edit/' . $payment->reservation_id;

            if ($request->hashed_value == $hash) {
                if (Route::currentRouteName() == 'payment.return') {
                    $payment->return_data = $data;
                } else if (Route::currentRouteName() == 'payment.callback') {
                    $payment->callback_data = $data;
                }
                $payment->payment_method = $data['txn_type'] == 'cc' ? 'card' : 'online';
                $payment->transaction_id = $data['txn_ref'];
                $payment->status = $data['txn_status'];
                $payment->save();

                if (Route::currentRouteName() == 'payment.callback') {
                    return 'OK';
                } else {
                    switch ($request->txn_status) {
                        case 0:
                            // Failed
                            return view('payment.error', [
                                'data' => $data,
                                'message' => ['Payment failed.']
                            ]);
                            break;

                            default:
                            // Success OR Pending Authorization
                            $payment->reservation->status = $data['txn_status'] == 1;
                            $payment->reservation->save();
                            $data['payment'] = $payment;
                            return view('payment.success', ['data' => $data]);
                            break;
                    }
                }
            } else {
                $payment->status = 0;
                $payment->save();

                if (Route::currentRouteName() == 'payment.callback') {
                    return 'OK';
                } else {
                    return view('payment.error', [
                        'data' => $data,
                        'message' => ['Hash value is not valid. Payment transaction has been tampered.']
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return view('payment.error', [
                'data' => $data,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
