<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->status == 'all') {
            return response()->json([
                'success' => true,
                'data' => MenuResource::collection(Menu::orderBy('category', 'DESC')->get()),
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'data' => MenuResource::collection(Menu::where('status', 1)->orderBy('category', 'DESC')->get()),
            ], 200);
        }
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
                'data' => new MenuResource(Menu::where('id', $request->id)->firstOrFail()),
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
            $menu = Menu::findOrFail($request->id);
            if ($menu->image) {
                Storage::delete('public/menus/' . $menu->image);
            }
            $menu->delete();

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
