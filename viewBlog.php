<?php
session_start();

//check if user is logged in
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

//check if id is set
if(!isset($_GET['id'])){
    header("Location: index.php");
}

//connect to database
include_once('./includes/connect.php');

//get blog by id using pdo
$query = $conn->prepare("SELECT * FROM blog WHERE id = ?");
$query->bindValue(1, $_GET['id']);
$query->execute();
$blogContents=$query->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog</title>
</head>
<body>
    
</body>
</html>