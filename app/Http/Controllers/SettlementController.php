<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Http\Resources\SettlementResource;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Settlement;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function transactions()
    {
        switch (auth()->user()->roles()->get()->pluck("name")->first()) {
            case 'admin':
                $totalTransaction = Reservation::whereIn('status', [1, 3])
                    ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(now()->startOfMonth())), date('Y-m-d 23:59:59', strtotime(now()->endOfMonth()))])
                    ->sum('amount_paid');
                $history = [];
                $settlements = SettlementResource::collection(Settlement::latest()->get());
                break;

            case 'canteen-worker':
                $totalTransaction = Reservation::whereIn('status', [1, 3])
                    ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(now()->startOfMonth())), date('Y-m-d 23:59:59', strtotime(now()->endOfMonth()))])
                    ->sum('amount_paid');
                $history = [];
                $settlements = SettlementResource::collection(auth()->user()->settlements);
                break;

            case 'parent':
                $totalTransaction = Reservation::where('user_id', auth()->user()->id)
                    ->whereIn('status', [1, 3])
                    ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('amount_paid');
                $history = ReservationResource::collection(Reservation::where('user_id', auth()->user()->id)->whereIn('status', [1, 3])->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->latest()->get());
                $settlements = [];
                break;

            default:
                $totalTransaction = 0;
                $history = [];
                $settlements = [];
                break;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'totalTransaction' => $totalTransaction,
                'history' => $history,
                'settlements' => $settlements,
            ],
        ], 200);
    }

    public function checkWithdrawal(Request $request)
    {
        $appliedSettlement = auth()->user()->settlements->pluck('payment_data');

        $appliedSettlementList = [];
        foreach ($appliedSettlement as $settlement) {
            $appliedSettlementList = [...$appliedSettlementList, ...$settlement];
        }

        $unclaimedSettlement = Payment::whereNotIn('id', $appliedSettlementList)->where('status', 1);
        $totalTransaction = count($unclaimedSettlement->get());
        $totalClaimAmount = $unclaimedSettlement->sum('amount');

        return response()->json([
            'success' => true,
            'data' => [
                'totalTransaction' => $totalTransaction,
                'totalClaimAmount' => $totalClaimAmount,
            ],
        ], 200);
    }

    public function makeWithdrawal()
    {
        $appliedSettlement = auth()->user()->settlements->pluck('payment_data');

        $appliedSettlementList = [];
        foreach ($appliedSettlement as $settlement) {
            $appliedSettlementList = [...$appliedSettlementList, ...$settlement];
        }

        $unclaimedSettlement = Payment::whereNotIn('id', $appliedSettlementList)->where('status', 1);
        $totalTransaction = count($unclaimedSettlement->get());
        $totalClaimAmount = $unclaimedSettlement->sum('amount');

        if ($totalTransaction < 1) {
            return response()->json([
                'success' => false,
                'message' => 'No available transaction to claim',
            ], 400);
        } else {
            $settlement = Settlement::create([
                'user_id' => auth()->user()->id,
                'payment_data' => $unclaimedSettlement->get()->pluck('id'),
                'amount' => $totalClaimAmount,
                'status' => 0,
            ]);

            return response()->json([
                'success' => true,
            ], 201);
        }
    }

    public function processWithdrawal(Request $request)
    {
        $settlement = Settlement::find($request->id);
        $settlement->status = 1;
        $settlement->save();

        return response()->json([
            'success' => true,
        ], 200);
    }
}
