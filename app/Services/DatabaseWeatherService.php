<?php

namespace App\Services;

use GuzzleHttp\Client;

class DatabaseWeatherService
{
    protected $client;
    protected $apiHost;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiHost = 'open-weather13.p.rapidapi.com';
        $this->apiKey = '3722283417msh8ff7245707817a9p18a740jsn420588eb1f1a'; // Replace with your actual API key
    }

    public function fetchWeather($city, $countryCode)
    {
        $response = $this->client->request('GET', "https://{$this->apiHost}/city/{$city}/{$countryCode}?units=imperial", [
            'headers' => [
                'x-rapidapi-host' => $this->apiHost,
                'x-rapidapi-key' => $this->apiKey,
            ],
        ]);

        $weatherData = json_decode($response->getBody(), true);

        if ($this->isValidWeatherData($weatherData)) {
            // Convert temperature from Fahrenheit to Celsius
            $weatherData['main']['temp'] = round(($weatherData['main']['temp'] - 32) * (5/9), 2);
        }

        return $weatherData;
    }

    protected function isValidWeatherData($weatherData)
    {
        return isset($weatherData['main']['temp']) && isset($weatherData['main']['humidity']) && isset($weatherData['weather'][0]['description']);
    }
}
