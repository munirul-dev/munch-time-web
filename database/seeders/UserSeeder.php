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

        $user = User::updateOrCreate([
            'email' => 'worker1@munchtime.com',
        ], [
            'name' => 'Canteen Worker 1',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => true,
        ]);
        $user->assignRole('canteen-worker');

        $user = User::updateOrCreate([
            'email' => 'worker2@munchtime.com',
        ], [
            'name' => 'Canteen Worker 2',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => true,
        ]);
        $user->assignRole('canteen-worker');

        $user = User::updateOrCreate([
            'email' => 'parent1@munchtime.com',
        ], [
            'name' => 'Parent 1',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => true,
        ]);
        $user->assignRole('parent');

        $user = User::updateOrCreate([
                'email' => 'parent2@munchtime.com',
            ], [
                'name' => 'Parent 2',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status' => true,
            ]);
        $user->assignRole('parent');

        $user = User::updateOrCreate([
            'email' => 'parent3@munchtime.com',
        ], [
            'name' => 'Parent 3',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => true,
        ]);
        $user->assignRole('parent');
    }
}
