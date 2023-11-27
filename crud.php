<?php

class User {
    public $email;
    public $password;
//Declares two public prop, where user value is stored

    public function __construct($email, $password) {
//def const method for user class, special method that is auto called when new obj is created 
        
        $this->email = $email;
        $this->password = $password; 
//access prop. and meth. of obj, assign value of const. prop.
    }
}

function create_user($email, $password) {
    $user = new User($email, $password);
//Params r passed to constuctor user class to initialize the email and pass prop of new obj
//Assumes that user class with constructor similiar to one descibed in prev respons is avaiable
    return $user; 
//returns user obj from func
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