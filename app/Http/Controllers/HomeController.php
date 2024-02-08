<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Http\Resources\StudentReservationResource;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Student;
use App\Models\User;

class HomeController extends Controller
{
    public function dashboard()
    {
        $userRole = auth()->user()->roles()->get()->pluck("name")->first();
        switch ($userRole) {
            case 'admin':
                $lastTransaction = Reservation::whereIn('status', [1, 3])->latest()->first();
                $totalAmount = 0;
                foreach (Reservation::where('date', date('Y-m-d'))->whereIn('status', [1, 3])->get() as $reservation) {
                    $totalAmount += $reservation->amount_paid;
                }
                return response()->json(['success' => true,
                    'data' => [
                        'dailyAmount' => $totalAmount,
                        'lastestTransaction' => [
                            'amount' => $lastTransaction ? $lastTransaction->amount_paid : 0,
                            'date' => $lastTransaction ? date('d/m/Y', strtotime($lastTransaction->date)) : '',
                        ],
                        'students' => [],
                        'reservations' => ReservationResource::collection(Reservation::where('date', date('Y-m-d'))->whereIn('status', [1, 3])->latest()->get()),
                        'count_user' => [
                            'admin' => User::role('admin')->count(),
                            'canteen_worker' => User::role('canteen-worker')->count(),
                            'parent' => User::role('parent')->count(),
                            'student' => Student::count(),
                        ],
                        'count_payment' => [
                            'success' => Payment::where('status', 1)->count(),
                            'failed' => Payment::where('status', 0)->count(),
                            'pending' => Payment::where('status', 2)->count(),
                        ],
                        'count_reservation' => [
                            'unpaid' => 0,
                            'pending' => 0,
                            'cancelled' => 0,
                            'redeemed' => 0,
                        ]

                    ],
                ], 200);

            case 'canteen-worker':
                $lastTransaction = Reservation::whereIn('status', [1, 3])->latest()->first();
                $totalAmount = 0;
                foreach (Reservation::where('date', date('Y-m-d'))->whereIn('status', [1, 3])->get() as $reservation) {
                    $totalAmount += $reservation->amount_paid;
                }
                return response()->json([
                    'success' => true,
                    'data' => [
                        'dailyAmount' => $totalAmount,
                        'lastestTransaction' => [
                            'amount' => $lastTransaction ? $lastTransaction->amount_paid : 0,
                            'date' => $lastTransaction ? date('d/m/Y', strtotime($lastTransaction->date)) : '',
                        ],
                        'students' => [],
                        'reservations' => ReservationResource::collection(Reservation::where('date', date('Y-m-d'))->whereIn('status', [1, 3])->latest()->get()),
                        'count_user' => [
                            'admin' => 0,
                            'canteen_worker' => 0,
                            'parent' => 0,
                            'student' => 0,
                        ],
                        'count_payment' => [
                            'success' => 0,
                            'failed' => 0,
                            'pending' => 0,
                        ],
                        'count_reservation' => [
                            'unpaid' => Reservation::where('status', 0)->count(),
                            'pending' => Reservation::where('status', 1)->count(),
                            'cancelled' => Reservation::where('status', 2)->count(),
                            'redeemed' => Reservation::where('status', 3)->count(),
                        ]
                    ],
                ], 200);

            case 'parent':
                $lastTransaction = auth()->user()->reservations->whereIn('status', [1, 3])->last()->first();
                $totalAmount = 0;
                foreach (auth()->user()->reservations()->where('date', date('Y-m-d'))->whereIn('status', [1, 3])->get() as $reservation) {
                    $totalAmount += $reservation->amount_paid;
                }
                return response()->json([
                    'success' => true,
                    'data' => [
                        'dailyAmount' => $totalAmount,
                        'lastestTransaction' => [
                            'amount' => $lastTransaction ? $lastTransaction->amount_paid : 0,
                            'date' => $lastTransaction ? date('d/m/Y', strtotime($lastTransaction->date)) : '',
                        ],
                        'students' => StudentReservationResource::collection(auth()->user()->students),
                        'reservations' => [],
                        'count_user' => [
                            'admin' => 0,
                            'canteen_worker' => 0,
                            'parent' => 0,
                            'student' => 0,
                        ],
                        'count_payment' => [
                            'success' => 0,
                            'failed' => 0,
                            'pending' => 0,
                        ],
                        'count_reservation' => [
                            'unpaid' => 0,
                            'pending' => 0,
                            'cancelled' => 0,
                            'redeemed' => 0,
                        ]
                    ],
                ], 200);

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Unknown user role',
                ], 400);
        }
    }
}
