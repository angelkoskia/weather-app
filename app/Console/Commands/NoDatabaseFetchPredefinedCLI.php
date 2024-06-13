<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NoDatabaseWeatherService;

class NoDatabaseFetchPredefinedCLI extends Command
{
    protected $signature = 'weather:noDataBaseCLIDefined';
    protected $description = 'Fetch weather data for predefined cities every hour';

    protected $weatherService;

    public function __construct(NoDatabaseWeatherService $weatherService)
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
            $this->fetchWeatherData($city['city'], $city['country_code']);
        }

        $this->info('Weather data fetched successfully!');
    }

    protected function fetchWeatherData($city, $countryCode)
    {
        $weatherData = $this->weatherService->fetchWeather($city, $countryCode);

        if ($weatherData) {
            $this->info("Weather data for {$city} ({$countryCode}): Temperature - {$weatherData['main']['temp']}°C, Humidity - {$weatherData['main']['humidity']}, Description - {$weatherData['weather'][0]['description']}");
        } else {
            $this->error('Failed to fetch weather data for ' . $city);
        }
    }
}
