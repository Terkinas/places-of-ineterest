<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::all();
        $urls = Storage::url('images/locations/');
        // dd($urls);
        return response()->json([
            'locations' => $locations,
            'url' => $urls
        ]);
    }

    public function indexAdmin(Request $request)
    {
        if (auth()->user()->email != 'admin@gmail.com') {
            return response()->json([
                'status' => 'unauthorized'
            ]);
        }
        $locations = Location::all();

        return response()->json([
            'locations' => $locations
        ]);
    }

    public function store(Request $request)
    {
        Log::debug($request->photo);

        if (auth()->user()->email != 'admin@gmail.com') {
            return response()->json([
                'status' => 'unauthorized'
            ]);
        }

        if ($request->hasFile('photo')) {
            Log::debug('there is');


            function generateRandomString($length = 10)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }


            $randName = generateRandomString(10);
            $file = $request->file('photo');
            $filename = $file->getClientOriginalExtension();
            $finalName = date('His')  . '-image-' . $request->title . '.jpg';

            $filepath = $file->storeAs('/images/locations/', $finalName, 'public');



            $longitude = (float) $request->longitude;
            $latitude = (float) $request->latitude;
            Log::debug($longitude);
            Log::debug($latitude);

            Location::create([
                'title' => $request->title,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'description' => $request->description,
                'image_name' => $finalName,
                'image_path' => $filepath,
            ]);
        } else {
            return response()->json([
                'error' => 'Please select the image'
            ]);
        }
    }

    public function delete($id, Request $request)
    {


        if (auth()->user()->email == 'admin@gmail.com') {

            $location = Location::find($id);
            $location->delete();

            return response()->json([
                'status' => 'successfully deleted',
                'id' => $id
            ]);
        }
        if (auth()->user()) {
        }

        return response()->json([
            'status' => 'feafea',
        ]);
    }

    public function onlyLocations(Request $request)
    {
        $locations = Location::all();

        return response()->json([
            'locations' => $locations
        ]);
    }
}
