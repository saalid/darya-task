<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;
use App\Jobs\FetchWeatherJob;

class WeatherController extends Controller
{
    public function submitLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        FetchWeatherJob::dispatch($request->latitude, $request->longitude);
        return response()->json(['message' => 'Weather job submitted']);
    }

    public function getWeather(Request $request)
    {
        return Weather::latest()->first();
    }
}
