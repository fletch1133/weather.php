<?php

$apiKey = 'd1c4f27fc31bce1425a6079e248a8bde';

$cities = ['New York, New York, United States',
            'London, England',
            'Toyko, Japan',
            'Paris, France',
            'Berlin, Germany',
            'Scranton, Pennsylvania, United States',
            'Charleston, South Carolina, United States',
            'Shanghi, China',
            'Rome, Italy',
            'Los Angeles, California, United States'
];

$weatherDataList = [];

foreach ($cities as $city) {
    $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey";
    $weatherData = json_decode(file_get_contents($url), true);

    $weatherDataList[$city] = $weatherData;
//Add weather data to list
}

file_put_contents('weathers.json', json_encode($weatherDataList, JSON_PRETTY_PRINT));
//Save weather data to JSON file

echo "Weather data saved to weathers.json\n"; 
?>