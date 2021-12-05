<?php
session_start();

include_once('./includes/connect.php');


//check if logged or or redirect to login page
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}

//load all my blogs
$userid=$_SESSION['user_id'];

//get all blogs by userid using pdo
$sql="SELECT * FROM blog WHERE userid=:userid";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':userid',$userid);
$stmt->execute();
$blogs=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--tailwind cdn-->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>My Blogs</title>
</head>
<body class="bg-gray-400">

    <!--list all blogs-->
    <div class="container mx-auto">
        <h1 class="text-center text-5xl font-bold">My Blogs</h1>
        <div class="flex flex-wrap justify-center">
            <?php foreach($blogs as $blog): ?>
                <div class="w-full max-w-sm p-2">
                    <div class="bg-white border-2 py-6 border-gray-1 rounded shadow-md p-4">
                        <p class="text-gray-700 text-base">
                            <?php echo $blog['title']; ?>
                        </p>
              
                        <p class="text-gray-700 text-base">
                            <?php echo $blog['content']; ?>
                        </p>
                        <p class="text-gray-700 mb-4 text-base">
                            <?php echo $blog['created']; ?>
                        </p>
                 
                        <a href="edit.php?id=<?php echo $blog['id']; ?>" class="bg-blue-500 hover:bg-blue-700 mt-2 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <a href="delete.php?id=<?php echo $blog['id']; ?>" class="bg-red-500 hover:bg-red-700 mt-2 text-white font-bold py-2 px-4 rounded">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    
</body>
</html>