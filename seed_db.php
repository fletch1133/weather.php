<?php

use Illuminate\Database\Capsule\Manager as Capsule;
//Imports Capsule manager from Ill\DB namespace annd gives it alias Capsule

use Illuminate\Database\Schema\Blueprint;
//Import Blueprint class from I\D\S, used for def. structure of DB tables

require __DIR__.'/vendor/autoload.php';
//Includes composer autoloader, manager dependencies and ensures that classes
//Are loaded automatically

$capsule = new Capsule;
//Creates new instance of capsule manager, part of Eloquent ORM in Laravel
//Convenient way to work with DB's

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
//Adds DB config to Capsule, arr passed as arg, 'driver' = details

$capsule->setAsGlobal();
//Sets Capsule manager as global, easy to use the DB across different parts of code

$capsule->bootEloquent();
//Boots up Eloquent ORM, initializes Eloquent to work with configured DB connections


Capsule::schema()->dropIfExists('weathers');
//Uses Capsule builder to drop weathers table if already exists, dropIfExists mth.
//Way to check existence of table and drop if does

Capsule::schema()->create('weathers', function (Blueprint $table) {
    $table->increments('id');
    $table->string('location');
    $table->integer('temperature');
    $table->integer('humidity');
    $table->integer('wind_speed');
    $table->string('conditions');
    $table->timestamps();
});
//Creates new weathers table using create meth. closure func defines table structure
//Using blueprint instance, specifies columns - eq id, location -


//Load data from JSON
$weatherData = json_decode(file_get_contents(public_path("auto_data/weathers.json")));

//Insert weather data into database
foreach ($weatherData as $weather) {
    Weather::create($weather);
}

echo "Weather data loaded into the database\n";