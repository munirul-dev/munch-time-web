<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\StudentResource;
use App\Models\Reservation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => ReservationResource::collection(Reservation::latest()->get()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => new ReservationResource(Reservation::findOrFail($request->id)),
                'payment' => new PaymentResource(Reservation::findOrFail($request->id)->payment),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function scanQR(Request $request)
    {
        try {
            $studentId = Crypt::decryptString($request->id);
            $selectedStudent = Student::find($studentId);
            if ($selectedStudent) {
                $reservation = Reservation::where([
                    ['student_id', '=', $studentId],
                    ['date', '=', date('Y-m-d')],
                    ['status', '=', 1]
                ])->first();
                return response()->json([
                    'status' => true,
                    'data' => [
                        'student' => new StudentResource($selectedStudent),
                        'reservation' => $reservation ? new ReservationResource($reservation) : null,
                    ],
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'QR Code not found',
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function redeem(Request $request)
    {
        try {
            Reservation::where('id', $request->id)->update(['status' => 3]);
            return response()->json([
                'status' => true,
                'message' => 'Reservation redeemed successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancel(Request $request)
    {
        Reservation::where('id', $request->id)->update(['status' => 2]);
    }
}
