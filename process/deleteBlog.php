<?php
session_start();
//check if user is logged in or redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}


//connect to database
include("../includes/connect.php");


$userid=$_SESSION['user_id'];

//check if blogid is set
if(isset($_GET['id'])){
    $blogid=$_GET['id'];

    //check if blog is owned by userid using pdo
    $query=$conn->prepare("SELECT * FROM blog WHERE id=? AND userid=?");
    $query->bindValue(1,$blogid);
    $query->bindValue(2,$userid);
    $query->execute();
    
    $valid=$query->fetchAll(PDO::FETCH_ASSOC);

    if($valid){
        //the blog is owned by the user
        
        //delete blog
        $query=$conn->prepare("DELETE FROM blog WHERE id=?");
        $query->bindValue(1,$blogid);
        $query->execute();
        

        //publish is done redirect back to myBlogs
        header("Location: ../myBlogs.php");


    }


}else{
    header("Location: ../index.php");
    exit();
}



?>