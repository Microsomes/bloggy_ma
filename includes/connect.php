<?php
//show errors for debugging purposes, to see what errors their are
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//defines the database that will be used
$DB_NAME="bloggy";


/**
 * I used this file to establish a connetion to the database.
 */


// Create connection using pdo

$servername = "localhost";
$username = "mag";
$password = "magpass";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$DB_NAME", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>