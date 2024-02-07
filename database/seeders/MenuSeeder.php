<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rice
        $menu = Menu::updateOrCreate([
            'name' => 'Nasi Lemak',
            'category' => 'Rice',
        ], [
            'price' => 2,
            'quantity' => 100,
            'image' => null,
            'description' => 'Coconut rice with egg and anchovies',
            'ingredient' => 'Rice, egg, anchovies',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Nasi Ayam',
            'category' => 'Rice',
        ], [
            'price' => 3,
            'quantity' => 100,
            'image' => null,
            'description' => 'Chicken rice with cucumber and soup',
            'ingredient' => 'Rice, chicken, cucumber, soup',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Fried Rice',
            'category' => 'Rice',
        ], [
            'price' => 3,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried rice with egg and chicken',
            'ingredient' => 'Rice, egg, chicken',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Fried Rice',
            'category' => 'Rice',
        ], [
            'price' => 3,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried rice with egg and chicken',
            'ingredient' => 'Rice, egg, chicken',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Seafood Fried Rice',
            'category' => 'Rice',
        ], [
            'price' => 4,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried rice with egg, shrimp, and squid',
            'ingredient' => 'Rice, egg, shrimp, squid',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Special Fried Rice',
            'category' => 'Rice',
        ], [
            'price' => 5,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried rice with egg, chicken, shrimp, and squid',
            'ingredient' => 'Rice, egg, chicken, shrimp, squid',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        // Noodles
        $menu = Menu::updateOrCreate([
            'name' => 'Fried Noodles',
            'category' => 'Noodles',
        ], [
            'price' => 3,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried noodles with egg and chicken',
            'ingredient' => 'Noodles, egg, chicken',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Fried Noodles Seafood',
            'category' => 'Noodles',
        ], [
            'price' => 4,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried noodles with egg, shrimp, and squid',
            'ingredient' => 'Noodles, egg, shrimp, squid',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Fried Noodles Special',
            'category' => 'Noodles',
        ], [
            'price' => 5,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried noodles with egg, chicken, shrimp, and squid',
            'ingredient' => 'Noodles, egg, chicken, shrimp, squid',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        // Sides
        $menu = Menu::updateOrCreate([
            'name' => 'Ayam Goreng',
            'category' => 'Sides',
        ], [
            'price' => 2,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried chicken with sauce',
            'ingredient' => 'Chicken',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Chicken Nuggets',
            'category' => 'Sides',
        ], [
            'price' => 2,
            'quantity' => 100,
            'image' => null,
            'description' => 'Chicken nuggets with sauce',
            'ingredient' => 'Chicken',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'French Fries',
            'category' => 'Sides',
        ], [
            'price' => 2,
            'quantity' => 100,
            'image' => null,
            'description' => 'French fries',
            'ingredient' => 'Potato',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Fried Banana',
            'category' => 'Sides',
        ], [
            'price' => 2,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fried banana',
            'ingredient' => 'Banana',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        // Drinks
        $menu = Menu::updateOrCreate([
            'name' => 'Mineral Water',
            'category' => 'Drinks',
        ], [
            'price' => 1,
            'quantity' => 100,
            'image' => null,
            'description' => 'Mineral water 600ml',
            'ingredient' => 'Water',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Cold Water',
            'category' => 'Drinks',
        ], [
            'price' => 0.5,
            'quantity' => 100,
            'image' => null,
            'description' => 'Cold water 600ml',
            'ingredient' => 'Water',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Hot Water',
            'category' => 'Drinks',
        ], [
            'price' => 0.5,
            'quantity' => 100,
            'image' => null,
            'description' => 'Hot water 600ml',
            'ingredient' => 'Water',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        // Diary
        $menu = Menu::updateOrCreate([
            'name' => 'Fresh Milk',
            'category' => 'Diary',
        ], [
            'price' => 1.5,
            'quantity' => 100,
            'image' => null,
            'description' => 'Fresh milk 200ml',
            'ingredient' => 'Milk',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        // Juice
        $menu = Menu::updateOrCreate([
            'name' => 'Orange Juice',
            'category' => 'Juice',
        ], [
            'price' => 1.5,
            'quantity' => 100,
            'image' => null,
            'description' => 'Orange juice 200ml',
            'ingredient' => 'Orange',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Apple Juice',
            'category' => 'Juice',
        ], [
            'price' => 1.5,
            'quantity' => 100,
            'image' => null,
            'description' => 'Apple juice 200ml',
            'ingredient' => 'Apple',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));

        $menu = Menu::updateOrCreate([
            'name' => 'Mango Juice',
            'category' => 'Juice',
        ], [
            'price' => 1.5,
            'quantity' => 100,
            'image' => null,
            'description' => 'Mango juice 200ml',
            'ingredient' => 'Mango',
            'status' => true,
        ]);
        $menu->image = $menu->id . '.png';
        $menu->save();
        copy(public_path('menu_seeder/' . $menu->image), storage_path('app/public/menus/' . $menu->image));
    }
}
