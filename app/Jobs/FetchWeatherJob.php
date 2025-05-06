<?php

namespace App\Jobs;

use App\Models\Weather;
use App\Services\WeatherApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class FetchWeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public float $lat;
    public float $long;

    public function __construct(float $lat, float $long)
    {
        $this->lat = $lat;
        $this->long = $long;
    }

    /**
     * @param WeatherApiService $weatherApi
     * @return void
     * @throws \Exception
     */
    public function handle(WeatherApiService $weatherApi): void
    {
        Log::info("FetchWeatherJob started for coordinates: {$this->lat}, {$this->long}");

        try {
            $data = $weatherApi->fetchByCoordinates($this->lat, $this->long);

            Weather::create([
                'latitude' => $this->lat,
                'longitude' => $this->long,
                'high' => $data['high'],
                'low' => $data['low'],
                'weather' => $data['weather'],
                'sunrise' => $data['sunrise'],
                'sunset' => $data['sunset'],
            ]);

            Log::info("Weather data saved successfully for: {$this->lat}, {$this->long}");
        } catch (\Exception $e) {
            Log::error("Failed to fetch weather: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            throw $e;
        }
    }
}
