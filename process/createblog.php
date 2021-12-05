<?php
session_start();
include_once('../includes/connect.php');



//responsible for creating a new blog

//check if title and content is present
if(isset($_POST['title']) && isset($_POST['content'])){
    //check if title and content is not empty
    print_r($_POST);

    $userid=$_SESSION['user_id'];

    $title=$_POST['title'];
    $content=$_POST['content'];
    $categoryid= $_POST['category'];

    


}else{
    //redirect to createblog.php

    echo "title or content is empty";
    echo '<a href="../createblog.php"> Back</a>';

}


?>