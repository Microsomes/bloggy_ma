<?php
//show errors for debugging purposes, to see what errors their are
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//defines the database that will be used
$DB_NAME="db1915345";


/**
 * I used this file to establish a connetion to the database.
 */


// Create connection using pdo

$isLocal=true;

$servername = $isLocal  ? "localhost":"mi-linux.wlv.ac.uk:3306";
$username =   $isLocal  ? "mag":"1915345";
$password =   $isLocal  ? "magpass":"wlv123";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$DB_NAME", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>