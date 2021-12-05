<?php
session_start();

include_once("./includes/connect.php");

//get all categories from table using pdo
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

$categories = $result->fetchAll(PDO::FETCH_ASSOC);

$totalCategories=count($categories);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <!--tailwind cdn -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>

<!--create blog post form-->
<div class="container flex-col bg-gray-400 flex items-center h-screen justify-center mx-auto">

        <h1>
            <a href="index.php" class="text-2xl text-gray-800 font-bold">
                Bloggy
            </a>
        </h1>


    <div class="mt-6 flex justify-center">
        <div class="w-full max-w-sm">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="process/createblog.php" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" placeholder="Title">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                        Content
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" name="content" placeholder="Content"></textarea>
                </div>

                    <!--php foreach for categories select-->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                            Category
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" name="category">
                            <option disabled>Select a Category</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo $category['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Create
                    </button>
                </div>

                <!--success message blog created-->
                <?php if(isset($_GET['id'])): ?>
                    <div class="mt-5 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>Blog Created <a href="viewBlog.php?id=<?php echo $_GET['id'];?>">View</a></p>
                    </div>
                <?php endif; ?>


            </form>
        </div>
    </div>
    
</body>
</html>