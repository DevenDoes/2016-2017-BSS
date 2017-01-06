<?php

function dbConnect($DB_DATABASE) {
// Connecting to Database
//REPLACE AS NEEDED
    $DB_USERNAME = 'root';
    $DB_PASSWORD = '';
    $DB_HOST = 'localhost';
    $mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

// Check connection
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
    return $mysqli;
}
