<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

include_once("./includes/connect.php");

//get all published blogs using pdo
$sql = "SELECT *,members.username as owner FROM blog  INNER JOIN members ON members.id=blog.userid INNER JOIN categories ON categories.id=blog.categoryid WHERE published=1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--tailwind cdn-->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <title>Published Blogs</title>
</head>
<body class="bg-gray-400">

    <!--list published blogs-->
    <div class="container mx-auto">

    <h1 class="text-center mt-4 mb-4">
            <a href="index.php" class="text-2xl text-center text-gray-800 font-bold">
                BLoggy
            </a>
        </h1>


        <div class="flex flex-wrap">
            <?php foreach($blogs as $blog): ?>
                <div class="w-1/2 p-4">
                    <div class="bg-gray-200 p-4 rounded-lg">
                        <a class="underline" href="viewBlog.php?id=<?php echo $blog['id'];?>"><h3 class="text-xl font-bold"><?php echo $blog['title']; ?></h3></a>
                       Published By: <p class="uppercase text-gray-700"><?php echo $blog['owner']; ?></p>
                        <p class="text-gray-700"><?php echo $blog['content']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    
</body>
</html>