<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Weather;
use App\Services\DatabaseWeatherService;

class DatabaseFetchPredefinedCLI extends Command
{
    protected $signature = 'weather:dataBaseCLIDefined';
    protected $description = 'Fetch weather data for predefined cities every hour';

    protected $weatherService;

    public function __construct(DatabaseWeatherService $weatherService)
    {
        parent::__construct();
        $this->weatherService = $weatherService;
    }

    public function handle()
    {
        $cities = [
            ['city' => 'London', 'country_code' => 'EN'],
            ['city' => 'New York', 'country_code' => 'US'],
            ['city' => 'Paris', 'country_code' => 'FR'],
        ];

        foreach ($cities as $city) {
            $this->fetchAndStoreWeatherData($city['city'], $city['country_code']);
        }

        $this->info('Weather data fetched successfully!');
    }

    protected function fetchAndStoreWeatherData($city, $countryCode)
    {
        $weatherData = $this->weatherService->fetchWeather($city, $countryCode);

        if ($weatherData) {
            $existingWeather = Weather::where('city', $city)->where('country_code', $countryCode)->first();

            if ($existingWeather) {
                $existingWeather->update([
                    'temperature' => $weatherData['main']['temp'],
                    'humidity' => $weatherData['main']['humidity'],
                    'weather_description' => $weatherData['weather'][0]['description'],
                ]);
                $this->info('Weather data updated successfully for ' . $city);
            } else {
                Weather::create([
                    'city' => $city,
                    'country_code' => $countryCode,
                    'temperature' => $weatherData['main']['temp'],
                    'humidity' => $weatherData['main']['humidity'],
                    'weather_description' => $weatherData['weather'][0]['description'],
                ]);
                $this->info('Weather data fetched and stored successfully for ' . $city);
            }
        } else {
            $this->error('Failed to fetch weather data for ' . $city);
        }
    }
}
