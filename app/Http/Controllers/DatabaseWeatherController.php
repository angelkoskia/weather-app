<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;
use App\Services\DatabaseWeatherService;
use Illuminate\Support\Facades\Log;


class DatabaseWeatherController extends Controller
{
    protected $weatherService;

    public function __construct(DatabaseWeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function fetchAndStoreWeatherData($city, $countryCode)
    {
        $weatherData = $this->weatherService->fetchWeather($city, $countryCode);

        if (isset($weatherData['main']['temp']) && isset($weatherData['main']['humidity']) && isset($weatherData['weather'][0]['description'])) {
            Weather::updateOrCreate([
                'city' => $city,
                'country_code' => $countryCode,
                'temperature' => $weatherData['main']['temp'],
                'humidity' => $weatherData['main']['humidity'],
                'weather_description' => $weatherData['weather'][0]['description'],
            ]);

            Log::info('Weather data fetched and stored successfully for ' . $city);
        } else {
            Log::error('Invalid weather data format for ' . $city);
        }
    }

    public function showWeather()
    {
        $weatherData = Weather::all(); // Fetch all weather data from the database
        return view('dataBase', compact('weatherData'));
    }
}
