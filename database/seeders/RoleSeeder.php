<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $canteenWorker = Role::updateOrCreate(['name' => 'canteen-worker']);
        $parent = Role::updateOrCreate(['name' => 'parent']);
    }
}
