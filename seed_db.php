<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

require __DIR__.'/vendor/autoload.php';

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'pgsql',
    'host' => 'localhost',
    'database' => 'weather_app',
    'username' => 'postgres',
    'password' => 'secret_key',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '', 
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();


Capsule::schema()->dropIfExists('weathers');
Capsule::schema()->create('weathers', function (Blueprint $table) {
    $table->increments('id');
    $table->string('location');
    $table->integer('temperature');
    $table->integer('humidity');
    $table->integer('wind_speed');
    $table->string('conditions');
    $table->timestamps();
});


//Load data from JSON
$weatherData = json_decode(file_get_contents(public_path("auto_data/weathers.json")));

//Insert weather data into database
foreach ($weatherData as $weather) {
    Weather::create($weather);
}

echo "Weather data loaded into the database\n";