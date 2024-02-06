<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Menu::orderBy('category', 'DESC')->get(),
        ], 200);
    }

    public function create(Request $request)
    {
        try {
            $menu = Menu::create([
                'name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
                'quantity' => $request->quantity,
                // 'image' => $request->image,
                'description' => $request->description,
                'ingredient' => $request->ingredient,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Menu created successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function edit(Request $request)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => Menu::where('id', $request->id)->firstOrFail(),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $menu = Menu::where('id', $request->id)->firstOrFail();
            $menu->update([
                'name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
                'quantity' => $request->quantity,
                // 'image' => $request->image,
                'description' => $request->description,
                'ingredient' => $request->ingredient,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Menu updated successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            Menu::findOrFail($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Menu deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}
