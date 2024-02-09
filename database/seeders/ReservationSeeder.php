<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('parent')->get();
        foreach ($users as $user) {
            $studentsId = $user->students->pluck('id')->toArray();
            foreach ($studentsId as $studentId) {
                $lastWeek = now()->subWeek();
                for ($dayCount = 1; $dayCount <= 8; $dayCount++) {
                    $reservationDate = $lastWeek->addDays(1);
                    $randomMenu = Menu::inRandomOrder()->first();
                    $randomQuantity = rand(1, 3);
                    $amountPaid = $randomQuantity * $randomMenu->price;
                    $reservationStatus = $dayCount < 7 ? 3 : 1;

                    $reservation = Reservation::create([
                        'user_id' => $user->id,
                        'student_id' => $studentId,
                        'menu_id' => $randomMenu->id,
                        'quantity' => $randomQuantity,
                        'date' => $reservationDate,
                        'amount_paid' => $amountPaid,
                        'description' => $randomMenu->name,
                        'status' => $reservationStatus,
                        'created_at' => $reservationDate,
                    ]);

                    $orderId = 'TRX-' . $reservation->id . '-' . date('YmdHis');
                    Payment::create([
                        'user_id' => $user->id,
                        'reservation_id' => $reservation->id,
                        'order_id' => $orderId,
                        'payment_method' => 'online',
                        'amount' => $amountPaid,
                        'status' => 1,
                        'created_at' => $reservationDate,
                    ]);
                }
            }
        }
    }
}
