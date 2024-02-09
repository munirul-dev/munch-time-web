<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::delete(Storage::allFiles('public/menus'));
        Storage::delete(Storage::allFiles('public/users'));
        Storage::delete(Storage::allFiles('public/students'));

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            MenuSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
