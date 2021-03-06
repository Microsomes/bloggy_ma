<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login to Bloggy</title>

    <!--import tailwind cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">

</head>
<body class="bg-gray-400">

    <!--Login form-->
    <div class="container bg-gray-400 flex-col flex items-center h-screen justify-center mx-auto">

        <h1>
            <a href="index.php" class="text-2xl text-gray-800 font-bold">
                Car Bloggy
            </a>
        </h1>

        <div class="mt-6 flex justify-center">
            <div class="w-full max-w-sm">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="process/login.php" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Username
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text"
                        
                        value="<?php 
                        
                        if(isset($_GET['username'])){
                            echo $_GET['username'];
                        }
                        ?>"
                        placeholder="Username" 
                        name="username">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" name="password">
                        <!-- <p class="text-red-500 text-xs italic">Please choose a password.</p> -->
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login">
                            Sign In
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="signup.php">
                            Sign Up
                        </a>
                    </div>
                </form>
                <p class="text-center text-gray-500 text-xs">
                    &copy;2021 Car Bloggy All rights reserved.
    
</body>
</html>