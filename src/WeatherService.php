<?php

namespace WeatherWebApp;

use GuzzleHttp\Client;

class WeatherService
{
    private string $apiKey = '';
    private string $apiEndpoint = '';
    private Client $client;

    public function __construct() {
        $this->client = new Client();
    }

    public function getWeather(string $city): array
    {
        $response = $this->client->get($this->apiEndpoint, [
           'query' => [
               'q' => $city,
               'appid' => $this->apiKey,
               'units' => 'metric'
           ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return [
            'city' => $data['name'],
            'temperature' => $data['main']['temp'],
            'description' => $data['weather'][0]['description'],
            'humidity' => $data['main']['humidity']
        ];
    }
}