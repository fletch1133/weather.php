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

    protected $casts = [ 
        'location' => [
            'type' => 'string',
            'length' => 200,
            'nullable' = false,
        ],

        'temperature' => [
            'type' => 'integer',
            'nullable' => false,
        ],

        'humidity' => [
            'type' => 'integer',
            'nullable' => false,
        ],

        'wind_speed' => [
            'type' => 'integer',
            'nullable' => false,
        ],

        'conditions' => [
            'type' => 'string',
            'length' => 250,
            'nullable' => false,
        ]
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

    protected $casts = [
        'email' => [
            'type' => 'string',
            'length' => 50,
            'unique' => true,
            'nullable' => false,
        ],

        'password' => [
            'type' => 'string',
            'length' => 150,
            'nullable' => true,
        ]
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
        'user_id',
    ];

    protected $casts = [
        'email' => [
            'type' => 'string', 
            'length' => 50,
            'unique' => true,
            'nullable' => false,
        ],

        'password' => [ 
            'type' => 'string',
            'length' => 150,
            'nullable' => true,
        ],

        'user_id' => [
            'type' => 'integer',
            'nullable' => false,
        ]
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes); 
    }

    public function __toString() {
        return sprintf('<User id=%s account=%s', $this->id, $this->account);
    }
}

class City extends Model {
    protected $table = 'cities';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'city',
        'user_id',
    ];

    protected $casts = [
        'city' => [
            'type' => 'integer',
            'nullable' => true,
        ],

        'user_id' => [
            'type' => 'integer',
            'nullable' => false, 
        ]
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes); 
    } 

    public function __toString() { 
        return sprintf('<City id=%s city=%s user_id=%s', $this->id, $this->city, $this->user_id);
    }
}

class Country extends Model {
    protected $table = 'countries';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'country',
        'city',
        'user_id',
    ];

    protected $casts = [
        'country' => [
            'type' => 'string',
            'length' => 100,
            'nullable' = false,
        ]
        
        'city' => [
            'type' = 'string',
            'length' = 100,
            'nullable' = false,
        ]
    ]
}

class Favorite extends Model {
    protected $table = 'favorites';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'city',
        'user_id',
    ];

    protected $casts = [
        'city' => [
            'type' => 'string',
            'length' => 100,
            'nullable' => true,
        ],

        'user_id' => [
            'type' => 'integer',
            'nullable' => false,
        ]
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes); 
    }
}

?>