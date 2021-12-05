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

    //insert into blog table columns title content categoryid userid using pdo
    $sql="INSERT INTO blog (title,content,categoryid,userid) VALUES (:title,:content,:categoryid,:userid)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':title',$title);
    $stmt->bindParam(':content',$content);
    $stmt->bindParam(':categoryid',$categoryid);
    $stmt->bindParam(':userid',$userid);
    $stmt->execute();

    //get the id of the blog just created
    $blogid=$conn->lastInsertId();

    header('Location: ../createblog.php?id='.$blogid);





}else{
    //redirect to createblog.php

    echo "title or content is empty";
    echo '<a href="../createblog.php"> Back</a>';

}


?>