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

//paginate blogs
$total_blogs = count($blogs);
$blogs_per_page = 5;
$total_pages = ceil($total_blogs/$blogs_per_page);

$currentpage=0;


if(isset($_GET['page'])){
    $currentpage = $_GET['page'];
}

$blogs=array_slice($blogs,$currentpage,$blogs_per_page);




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

    <style>

        .disabled{
            pointer-events: none;
            cursor: default;
            opacity: 0.6;
        }
        .active{
            background-color: #f5f5f5;
        }

    </style>
</head>
<body class="bg-gray-400">

    <!--list published blogs-->
    <div class="container mx-auto">

    <h1 class="text-center mt-4 mb-4">
            <a href="index.php" class="text-2xl text-center text-gray-800 font-bold">
                Car BLoggy
            </a>
        </h1>


        <!--search blogs form nice ui-->
        <div class="flex justify-center mt-4">
            <form action="search.php" method="get">
                <div class="w-full max-w-sm">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-category">
                                Search Blogs
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-category" type="text" placeholder="Search Blogs" name="search">
                        </div>
                    </div>


                    <!--checkbox to search what columns -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-category">
                                Search in
                            </label>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <input class="mr-2 leading-tight" id="grid-category" type="checkbox" name="search_in[]" value="title">
                                    <label class="text-gray-700 text-xs font-bold mb-2" for="grid-category">
                                        Title
                                    </label>
                                </div>
                                <div class="w-full px-3">
                                    <input class="mr-2 leading-tight" id="grid-category" type="checkbox" name="search_in[]" value="body">
                                    <label class="text-gray-700 text-xs font-bold mb-2" for="grid-category">
                                        Content
                                    </label>
                                </div>
                              
                              
                            </div>
                        </div>
                    </div>


                  

                        
                        <!--select time range-->
                        <div class="w-full ">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-category">
                                Select Time Range
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-category" name="time">
                                    <option value="">Select Time Range</option>
                                    <option value="1">Last 24 Hours</option>
                                    <option value="2">Last Week</option>
                                    <option value="3">Last Month</option>
                                    <option value="4">Last Year</option>
                                    <option value="4">All</option>
                                </select>

                            </div>
                            </div>



                    </div>

                    <div class="flex mt-3 items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>



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


        <!--paginate blogs with button-->
        <div class="flex justify-center mt-4">
            <?php for($i=1;$i<=$total_pages;$i++): ?>
                <a href="viewAllPublishedBlogs.php?page=<?php echo $i-1; ?>" class="bg-gray-300 px-4 py-2 m-2 rounded-lg <?php if($i==$currentpage+1){echo 'active';} ?>"><?php echo $i; ?></a>
            <?php endfor; ?>



    </div>



    
</body>
</html>