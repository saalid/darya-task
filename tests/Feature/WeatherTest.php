<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_weather_request()
    {
        $response = $this->postJson('/api/weather-request', [
            'latitude' => 40.7128,
            'longitude' => -74.0060,
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Weather job submitted']);
    }

}
