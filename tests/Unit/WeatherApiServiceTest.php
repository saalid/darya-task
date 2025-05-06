<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Services\WeatherApiService;

class WeatherApiServiceTest extends TestCase
{
    public function test_fetch_by_coordinates_returns_expected_data()
    {
        Http::fake([
            'https://api2.com/location/*' => Http::response([
                'high' => 7.5,
                'low' => 4.3,
                'weather' => 'Cloudy',
                'sunrise' => '2025-01-20T07:15:00Z',
                'sunset' => '2025-01-20T17:30:00Z',
            ], 200),
        ]);

        $service = new WeatherApiService();

        $data = $service->fetchByCoordinates(40.7128, -74.0060);

        $this->assertEquals(7.5, $data['high']);
        $this->assertEquals(4.3, $data['low']);
        $this->assertEquals('Cloudy', $data['weather']);
    }
}
