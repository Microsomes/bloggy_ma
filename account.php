<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--tailwind cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">

    <title>My Account</title>
</head>
<body>
    <div class="h-screen w-screen bg-gray-400 flex items-center justify-center flex-col py-4">

    <h1>
            <a href="index.php" class="text-2xl text-center text-gray-800 font-bold">
                BLoggy
            </a>
        </h1>

    <h1 class="mt-6 text-xl text-bold">My Account</h1>
    <p class="mt-4 text-xl">Welcome <?php echo $_SESSION['username']; ?>!</p>
    <p class="text-xl"><?php echo $_SESSION['bio'];?></p>

    <p class="bg-white rounded-md hover:bg-gray-500 p-1 text-sm underline mt-5"><a href="createblog.php">Create Blog</a></p>

    <p class="bg-white rounded-md hover:bg-gray-500 p-1 text-sm underline mt-1"><a href="logout.php">My Blogs</a></p>

    <p class="bg-white rounded-md hover:bg-gray-500 p-1 text-sm underline mt-1"><a href="logout.php">Logout</a></p>
    </div>

    
</body>
</html>