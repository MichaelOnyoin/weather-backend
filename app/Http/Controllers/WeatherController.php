<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    //
     public function forecast(Request $request)
    {
        $city = $request->query('city', 'Nairobi');
        $units = $request->query('units', 'metric');
        $apiKey = env('OPENWEATHER_API_KEY');

        $response = Http::get("http://api.openweathermap.org/data/2.5/forecast", [
            'q' => $city,
            'units' => $units,
            'appid' => $apiKey,
        ]);
        // $response = Http::get("https://api.openweathermap.org/data/2.5/forecast?q=${city}&units=${units}&appid=${apiKey}");

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch weather data'], 500);
        }

        return $response->json();
    }
}
