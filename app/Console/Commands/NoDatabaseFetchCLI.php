<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NoDatabaseWeatherService;
use App\Http\Controllers\NoDatabaseWeatherController;

class NoDatabaseFetchCLI extends Command
{
    protected $signature = 'weather:noDataBaseCLI {city} {country_code?}';
    protected $description = 'Fetch weather data for a specific city';

    protected $weatherService;
    protected $weatherController;

    public function __construct(NoDatabaseWeatherService $weatherService, NoDatabaseWeatherController $weatherController)
    {
        parent::__construct();
        $this->weatherService = $weatherService;
        $this->weatherController = $weatherController;
    }

    public function handle()
    {
        $city = $this->argument('city');
        $countryCode = $this->argument('country_code') ?? 'EN';

        // Fetch weather data
        $weatherData = $this->weatherService->fetchWeather($city, $countryCode);

        if ($this->isValidWeatherData($weatherData)) {
            // Output weather information in the terminal
            $this->info("Weather for $city ($countryCode): Temperature - {$weatherData['main']['temp']}°C, Humidity - {$weatherData['main']['humidity']}, Description - {$weatherData['weather'][0]['description']}");

            // Render the blade template with weather information
            $this->weatherController->showWeather($city, $countryCode, $weatherData); // Pass weatherData as well
        } else {
            $this->error("Unable to fetch weather data for $city ($countryCode)");
        }
    }







    protected function isValidWeatherData($weatherData)
    {
        return isset($weatherData['main']['temp']) && isset($weatherData['main']['humidity']) && isset($weatherData['weather'][0]['description']);
    }
}
