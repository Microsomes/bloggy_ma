<?php
session_start();

$isLogged=false;
$username="";

if(isset($_SESSION['username'])){
    $isLogged=true;
    $username=$_SESSION['username'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--use tailwind cdn-->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <title>Bloggy</title>
</head>
<body>

    <div class="w-screen h-screen flex-col bg-gray-400 flex items-center justify-center">


       <h1 class="text-3xl"> Welcome to the Bloggy blog</h1>
       <p class="w-1/2 text-center mt-2">
           Read the latest news and updates from the world of technology, programming and web development.
       </p>

       <div class="flex w-1/2 mt-6 flex-wrap  justify-around">
           
       <a href="blogs.php"> <button class="btn hover:bg-gray-500 bg-white rounded-md p-1">
                     View Blogs
               </button></a>
            
            <?php if($isLogged){ ?>

                <a href="account.php"> <button class="btn hover:bg-gray-500 bg-white rounded-md p-1">
                     My Account (<?php echo $username; ?>)
               </button></a>

              
            <?php }else{ ?>
                <a href="login.php"> <button class="btn hover:bg-gray-500 bg-white rounded-md p-1">
                        Login/Signup
                </button></a>
            <?php } ?>

         


       </div>

    </div>
    
</body>
</html>