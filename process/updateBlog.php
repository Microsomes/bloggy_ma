<?php
session_start();
include_once('../includes/connect.php');



//responsible for updating a blog


//check if title and content is present
if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['blogid'])){
    //check if title and content is not empty

    $userid=$_SESSION['user_id'];

    $title=$_POST['title'];
    $content=$_POST['content'];
    $categoryid= $_POST['category'];

    $blogid=$_POST['blogid'];
    

    //update blog using pdo
    $sql="UPDATE blog SET title=:title, content=:content, categoryid=:categoryid WHERE id=:blogid";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':title',$title);
    $stmt->bindParam(':content',$content);
    $stmt->bindParam(':categoryid',$categoryid);
    $stmt->bindParam(':blogid',$blogid);
    $stmt->execute();



  
    
    header('Location: ../viewBlog.php?id='.$blogid);





}else{
    //redirect to createblog.php

    echo "title or content is empty";
    echo '<a href="../createblog.php"> Back</a>';

}


?>