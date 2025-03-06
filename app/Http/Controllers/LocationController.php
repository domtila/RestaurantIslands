<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{public function createLocation(Request $request){
        $request->validate(
            [

              'name'=>'required',
                'area_code'=>'required'
            ]
        );
        try{
            $location = new Location;
            $location->name = $request->name;
            $location->area_code = $request->area_code;

            $newLocation = $location->save();

            if($newLocation){
                return response()->json($newLocation);
            }
            else{
                return "Location Not Saved.";
            }

        } catch(\Exception $e){
            return response()->json([
                "Error"=>"Location Was not Created"
            ]);
        }
    }

    public function index(){
        try{
            $location = Location::all();

            if($location){
                return response()->json($location);
            }
            else{
                return "No Location Was found";
            }
        } catch(\Exception $e){
            return response()->json([
                "Error"=>"No Location Was Found!"
          ]);
        }
    }

    public function getLocation($id){
        try{
            $location = Location::findOrFail($id);

            if($location){
                return response()->json($location);
            }
            else{
                return "Location With id `$id` Was not found";
            }
        } catch(\Exception $e){
            return response()->json([
                "Error"=>"Location Not Found!"
            ]);
        }
    }
}
