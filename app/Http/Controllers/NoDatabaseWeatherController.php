<?php

namespace App\Http\Controllers;

use App\Services\NoDatabaseWeatherService;
use Illuminate\Http\Request;

class NoDatabaseWeatherController extends Controller
{
    protected $weatherService;

    public function __construct(NoDatabaseWeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function showWeather($city, $countryCode)
    {
        // Fetch weather data
        $weatherData = $this->weatherService->fetchWeather($city, $countryCode);

        if ($this->isValidWeatherData($weatherData)) {
            return view('noDatabase', compact('weatherData', 'city'));
        } else {
            return view('noDatabase', ['error' => 'Unable to fetch weather data']);
        }
    }

    protected function isValidWeatherData($weatherData)
    {
        return isset($weatherData['main']['temp']) && isset($weatherData['main']['humidity']) && isset($weatherData['weather'][0]['description']);
    }
}
