<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//Checks if curr req method is POST
    $name = $_POST['name'];
//Get values of name field 
    $email = $_POST['email'];
//Get value of email field 


    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
//Prepares SQL query for exeution
    $stmt->bind_param("ss", $name, $email);
//Binds values of params to placeholders in prepared stmts, ss says both are strings, prevent SQL injection

    $stmt->execute();
//Executes stmt, inserting values into users table of the database

    $stmt->close();
//Closes the prepared statement
}