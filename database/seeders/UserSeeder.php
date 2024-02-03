<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate([
            'email' => 'admin@munchtime.com',
        ], [
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => true,
        ]);
        $user->assignRole('admin');

        for ($count = 1; $count <= 2; $count++) {
            $user = User::updateOrCreate([
                'email' => "worker{$count}@munchtime.com",
            ], [
                'name' => "Canteen Worker $count",
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status' => true,
            ]);
            $user->assignRole('canteen-worker');
        }

        for ($count = 1; $count <= 3; $count++) {
            $user = User::updateOrCreate([
                'email' => "parent{$count}@munchtime.com",
            ], [
                'name' => "Parent $count",
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status' => true,
            ]);
            $user->assignRole('parent');
        }
    }
}
