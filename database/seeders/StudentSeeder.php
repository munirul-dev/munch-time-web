<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parents = User::role('parent')->get();

        foreach ($parents as $index => $parent) {
            for ($count = 0; $count < 3; $count++) {
                Student::updateOrCreate([
                    'user_id' => $parent->id,
                    'name' => "Student P" . ($index + 1) . "-" . sprintf("%02d", ($count + 1)),
                ]);
            }
        }
    }
}
