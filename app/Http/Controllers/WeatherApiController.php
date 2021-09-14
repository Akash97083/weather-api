<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherApiController extends Controller
{
    public function search(Request $request)
    {
        if (!$request->location) {
            $msg = 'Cod: 404. Message : Location required! ';
            logger()->error($msg);
            return response()->json([
                "status" => 404,
                "message" => "Location required!",
            ], 404);
        }

        $response = Weather::where('location', trim($request->location, '"\''))->first();

        if (!$response) {
            $msg = 'Cod: 404. Message: City not found! ';
            logger()->error($msg);
            abort(404, 'City not found !');
        }

        return response()->json([
            "status" => 200,
            "message" => "Weather of {$response->location}",
            "data" => [
                "location" => $response->location,
                "longitude" => $response->longitude,
                "latitude" => $response->latitude,
                "humadity" => $response->humadity,
                "temperature" => $response->temperature,
            ],
        ], 200);
    }
}
