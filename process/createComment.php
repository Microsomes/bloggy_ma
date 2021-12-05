<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once("../includes/connect.php");


//check if user is logged in if not redirect to login
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

//check if blogid is present
if(!isset($_POST['blogid'])){
    header("Location: ../index.php");
}

$userid= $_SESSION['user_id'];

$blogid = $_POST['blogid'];

$comment = $_POST['comment'];

//insert into blog_comments table using pdo
$sql = "INSERT INTO blog_comments (memberId, blogId, value) VALUES (:memberId, :blogid, :comment)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':memberId', $userid);
$stmt->bindParam(':blogid', $blogid);
$stmt->bindParam(':comment', $comment);
$stmt->execute();

//get last comment id
$last_id = $conn->lastInsertId();


header("Location: ../viewBlog.php?id=$blogid&commentid=$last_id&comment=success");


?>