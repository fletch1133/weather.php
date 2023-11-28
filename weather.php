<?php

namespace Weather; 

use Illuminate\Database\Eloquent\Model;

class Weather extends Model {
    protected $table = 'weathers';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'location', 
        'temperature',
        'humidity', 
        'wind_speed',
        'conditions', 
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes); 
    }

    public function getDateFormat() {
        return 'Y-m-d H:i:s';
    } 
}

//function create_weather($location, $temperature, $humidity, $wind_speed, $conditions) {
//    $weather = new Weather([
//        'location' => $location,
//        'temperature' => $temperature,
//        'humidity' => $humidity,
//        'wind_speed' => $wind_speed,
//        'conditions' => $conditions,
//    ]);

//    return $weather;
//} 


class User extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }

    public function __toString() {
        return sprintf('<User id=%s email=%s>', $this->id, $this->email);
    }
}

class Account extends Model {
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
    ]

    public function __construct(array $attributes = []) {
        parent::__construct($attributes); 
    }

    public function __toString() {
        return sprintf('<User id=%s account=%s', $this->id, $this->account);
    }
}

?>