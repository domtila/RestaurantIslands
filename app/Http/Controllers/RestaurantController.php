<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller

{
    public function createRestaurant(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
        ]);

        try {
            $Restaurant = Restaurant::create([
                'name' => $validatedData['name'],
                'location' => $validatedData['location'],
                'description' => $validatedData['description']
            ]);

            if ($Restaurant) {
                return response()->json("Restaurant Saved Successfully");
            } else {
                return response()->json("Restaurant Not Saved");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $Restaurants = Restaurant::all();

            if ($Restaurants) {
                return response()->json($Restaurants);
            } else {
                return response()->json("No Restaurant Found");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getRestaurant($id)
    {
        try {
            $Restaurant = Restaurant::findOrFail($id);

            if ($Restaurant) {
                return response()->json($Restaurant);
            } else {
                return response()->json("Restaurant With id `$id` Was not found");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateRestaurant(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string'
        ]);

        try {
            $Restaurant = Restaurant::findOrFail($id);
            $Restaurant->update([
                'name' => $validatedData['name'],
                'location' => $validatedData['location'],
                'description' => $validatedData['description']
            ]);

            return response()->json("Restaurant Updated Successfully");
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteRestaurant($id)
    {
        try {
            $existingRestaurant = Restaurant::findOrFail($id);
            if ($existingRestaurant) {
                $existingRestaurant->delete();
                return response()->json([
                    "Success" => "Restaurant id $id Deleted Successfully"
                ]);
            } else {
                return response()->json("Restaurant Not Found!");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
