<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include_once('../includes/connect.php');


    function username_taken($username){
        //check if members table if username already exists using pdo
        global $conn;
        $query = $conn->prepare("SELECT COUNT(*) FROM members WHERE username = :username");
        $query->bindValue(':username', $username);
        $query->execute();
        $rows = $query->fetchColumn();
        if($rows == 1){
            return true;
        }else{
            return false;
        }
    }

    

    function create_user($username, $password, $email){
        //create a new user in the database
        global $conn;
        $query = $conn->prepare("INSERT INTO members (username, password, email) VALUES (:username, :password, :email)");
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);
        $query->bindValue(':email', $email);
        $query->execute();



    }

    //check if username password and bio are present
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['bio'])){
        //check if username is not empty
        if(!empty($_POST['username'])){
            //check if password is not empty
            if(!empty($_POST['password'])){
                //check if bio is not empty
                if(!empty($_POST['bio'])){
                    //check if username is not taken
                    if(!username_taken($_POST['username'])){
                        //create user
                        create_user($_POST['username'], $_POST['password'], $_POST['bio']);
                        //redirect to login page
                        header('Location: login.php');
                    }else{
                        //username is taken
                        echo 'Username is taken';
                    }
                }else{
                    //bio is empty
                    echo 'Bio is empty';
                }
            }else{
                //password is empty
                echo 'Password is empty';
            }
        }else{
            //username is empty
            echo 'Username is empty';
            header('Location: ../signup.php?error=username');
        }
    }else{
        //form not submitted
        echo 'Form not submitted';
        header('Location: ../signup.php');
    }



?>