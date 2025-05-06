<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Weather;
use Illuminate\Support\Facades\Http;

class FetchWeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $lat;
    public $long;

    public function __construct($lat, $long)
    {
        $this->lat = $lat;
        $this->long = $long;
    }

    public function handle(): void
    {
        $response = Http::withHeaders([
            'Authorization' => '5678'
        ])->get("https://api2.com/location/{$this->lat},{$this->long}");

        if ($response->successful()) {
            $data = $response->json();

            Weather::create([
                'latitude' => $this->lat,
                'longitude' => $this->long,
                'high' => $data['high'],
                'low' => $data['low'],
                'weather' => $data['weather'],
                'sunrise' => $data['sunrise'],
                'sunset' => $data['sunset'],
            ]);
        }
    }
}
