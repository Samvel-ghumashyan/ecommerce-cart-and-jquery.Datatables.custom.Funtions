<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class GeoLocationUser extends Controller
{
    public function showLocation(Request $request)
    {
        $location = $request->get('location', app('geoip.location'));

        $latitude = $location->latitude;
        $longitude = $location->longitude;

        return view('location.index', [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    public function showLocationForIdUSer (Request $request){

            $order = Orders::where('id', $request->id)->first();

            $latitude = $order->address_latitude;
            $longitude = '44.4986';


            return view('location.userLocation', [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
        }
}

