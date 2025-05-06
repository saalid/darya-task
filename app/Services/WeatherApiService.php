<?php

namespace App\Services;

use Carbon\Carbon;

class WeatherApiService
{
    public function fetchByCoordinates(float $lat, float $long): array
    {
        // Mocking API 2 response structure
        return [
            'high' => 7.5,
            'low' => 4.3,
            'weather' => 'Cloudy',
            'sunrise' => Carbon::parse('2025-01-20T07:15:00Z')->toDateTimeString(),
            'sunset' => Carbon::parse('2025-01-20T17:30:00Z')->toDateTimeString(),
        ];
    }

    public function fetchByCity(string $city): array
    {
        // Mocking API 1 response structure
        return [
            'location' => [
                'city' => $city,
                'latitude' => 40.7128,
                'longitude' => -74.0060,
            ],
            'today_weather' => [
                'high_temp' => 7.5,
                'low_temp' => 4.3,
                'weather' => 'Cloudy',
                'sunrise' => '2025-01-20T07:15:00',
                'sunset' => '2025-01-20T17:30:00',
            ],
            'forecast' => [
                [
                    'date' => '2025-01-21',
                    'high_temp' => 10,
                    'low_temp' => 4,
                    'weather' => 'Partly Cloudy',
                ],
                [
                    'date' => '2025-01-22',
                    'high_temp' => 12,
                    'low_temp' => 6,
                    'weather' => 'Sunny',
                ],
                [
                    'date' => '2025-01-23',
                    'high_temp' => 8,
                    'low_temp' => 2,
                    'weather' => 'Rain',
                ],
            ],
        ];
    }
}
