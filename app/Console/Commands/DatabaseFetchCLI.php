<?php
// DatabaseFetchCLI.php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;
use App\Services\DatabaseWeatherService;

class DatabaseFetchCLI extends Command
{
    protected $signature = 'weather:dataBaseCLI {city} {country_code?}';
    protected $description = 'Fetch weather data for a specific city';

    protected $weatherService;

    public function __construct(DatabaseWeatherService $weatherService)
    {
        parent::__construct();
        $this->weatherService = $weatherService;
    }

    public function handle()
    {
        $city = $this->argument('city');
        $countryCode = $this->argument('country_code') ?? 'EN';

        $weatherData = $this->weatherService->fetchWeather($city, $countryCode);

        if ($this->isValidWeatherData($weatherData)) {
            $weather = Weather::updateOrCreate(
                ['city' => $city, 'country_code' => $countryCode],
                [
                    'temperature' => $weatherData['main']['temp'],
                    'humidity' => $weatherData['main']['humidity'],
                    'weather_description' => $weatherData['weather'][0]['description'],
                ]
            );

            if ($weather->wasRecentlyCreated) {
                $this->info("Weather data retrieved and stored successfully for $city ($countryCode)");
            } else {
                $this->info("Weather data updated successfully for $city ($countryCode)");
            }
        } else {
            $this->error("Unable to fetch weather data for $city ($countryCode)");
        }
    }

    protected function isValidWeatherData($weatherData)
    {
        return isset($weatherData['main']['temp']) && isset($weatherData['main']['humidity']) && isset($weatherData['weather'][0]['description']);
    }
}
