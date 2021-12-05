<?php
session_start();

include_once('../includes/connect.php');




//check if login credentials posted are correct


function checkLogin($username,$password){
    global $conn;
    //using pdo
    $sql = "SELECT * FROM members WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username',$username);
    $stmt->bindParam(':password',$password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);



    if($result){

        //set session variables
        $_SESSION['username'] = $result['username'];
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['logged_in'] = true;
        $_SESSION['bio']= $result['aboutme'];

        return true;
    }else{
        return false;
    }

}

//check if username and password was posted
if(isset($_POST['username']) && isset($_POST['password'])){
    //check if username and password are correct


    //check if username and password are not empty
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        //check if username and password are correct


        //check if username and password are correct

        $isValid=checkLogin($_POST['username'],$_POST['password']);

        if ($isValid){
            //is logged in
            header('Location: ../index.php');
        }else{
            //redirect to login page
            echo "Wrong username or password";
            echo "<a href='../login.php'> Try again</a>";
        }

        
        }else{
            echo "Username or Password is empty";
            echo "<a href='../login.php'> back </a>";

        }



}else{
    //redirect to login page
    echo "username and password not set";
    echo "<a href='../login.php'> back </a>";
}




?>