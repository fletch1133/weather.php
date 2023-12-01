<?php

use Weather\Weather;
use Weather\User;
use Weather\Account;
use Weather\Country;
use Weather\City;
use Weather\Favorite;


//class User {
//    public $email;
//    public $password;
////Declares two public prop, where user value is stored

//    public function __construct($email, $password) {
////def const method for user class, special method that is auto called when new obj is created 
        
//        $this->email = $email;
//        $this->password = $password; 
////access prop. and meth. of obj, assign value of const. prop.
//    }
//}

function create_user($email, $password) {
    return User::create([
//Indicates that func will return value, result of create method on User model        
        'email' => $email,
        'password' => $password,
//Assoc arr w/ data that will insert into users table, specify value
//for email & password columns that come from params email and password
    ]);
}


function get_users() {
    return User::all();
//Retrieves all records from users table
}


function get_user_by_id($user_id) {
    return User::find($user_id);
//Gets user by primary id, if !found returns null
}


function get_user_by_email($email) {
    return User::where('email', $email)->first();
//Creates query to where email column matches email, gets first result, !found = null
} 

function create_account($weather, $user = null) {
    $account = new Account([ 
        'weather' => $weather,
    ]);
//New instance of acc model, initial it with assoc. array where key weather
//Corresponds to weather param

    if ($user) {
        $account->user()->associate($user);
    }
//Check is user param is not null, if provided asoc user with account using
//Assoc. method, assumes relationship between account and user model
    
    $account->save();
//Saves account to DB, assumes account model extends Eloquent which provides
//Save method for persisting model to DB

    return $account;
//Returns created account instance
}

function get_account_by_id($user_id) {
    return Account::where('user_id', $user_id)->first();
//Query for account where user id matches user id param
//First method returns first result of query or null if none found
}

function get_weather_by_country_and_city($countryName, $cityName) {
    $weather = Weather::whereHas('city.country', function ($query) use ($countryName) {
//Use ORM to query weather table, whereHas meth. use filter result to check if 
//Relationship between Weather and City with nested relationship to Country if name matches
        $query->where('name', $countryName);
    })->whereHas('city', function ($query) use ($cityName) {
//Specifies condition within closure func to check if country name
//Matches provided $countryName
        $query->where('name', $cityName);
    })->first();
//Same as above but checks it matches $cityName

    return $weather;
//Returns result of query, if ! returns null
}


//UNSURE ABOUT THESE CURR FUNCS

function update_weather($weatherId, $newData) { 
    $weather = Weather::find($weatherId);

    if ($weather) {
        $weather->update($newData);
        return $weather;
    }

    return null;
}

function delete_weather($weatherId) {
    $weather = Weather::find($weatherId);

    if ($weather) {
        $weather->delete(); 
        return true;
    }

    return false;
}

function get_user_favorite_cities($userId) {
    $user = User::find($userId);
//
    if ($user) {
        return $user->favoriteCities; 
    }

    return null;
}

function get_weather_by_city($cityName) {
    $city = City::where('name', $cityName)->first();
    if ($city) {
        return $city->weather;
    }

    return null;
}

function get_all_countries() {
    return Country::all();
//Uses country model to retrieve all from countries table
}

function get_cities_by_country($countryName) {
    $country = Country::where('name', $countryName)->first();
    if ($country) {
        return $country->cities;
    }

    return null;
}

function get_user_weather_preferences($userId) {
    $user = User::find($userId);
    if ($user) {
        return $user->weatherPreferences;
    }

    return null;
}