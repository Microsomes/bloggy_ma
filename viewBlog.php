<?php
session_start();

//check if user is logged in
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

//check if id is set
if(!isset($_GET['id'])){
    header("Location: index.php");
}

//connect to database
include_once('./includes/connect.php');


$sql="select blog.*,categories.label as 'catlabel' from blog INNER JOIN categories ON categories.id=blog.categoryid where blog.id=?";

//get blog by id using pdo
$query = $conn->prepare($sql);



$query->bindValue(1, $_GET['id']);
$query->execute();
$blogContents=$query->fetch(PDO::FETCH_ASSOC);


$blogid= $blogContents['id'];
$blogTitle= $blogContents['title'];
$blogContent= $blogContents['content'];
$blogCreated= $blogContents['created'];
$categoryLabel= $blogContents['catlabel'];


//get comments
$sql="select * from blog_comments where blogid=? order by id desc";
$query = $conn->prepare($sql);
$query->bindValue(1, $blogid);
$query->execute();
$comments=$query->fetchAll(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--tailwind cdn-->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <title>
        <?php echo $blogTitle; ?>
    </title>
</head>
<body class="bg-gray-400">

    <div class=" bg-gray-400 flex flex-col justift-center">
    <!--show blog post-->


    <h1 class="mt-6 text-center">
            <a href="index.php" class="text-center text-2xl text-center text-gray-800 font-bold">
                BLoggy
            </a>
        </h1>


    <div class="container mx-auto p-12">

    
     

        <div class="mt-6 flex flex-col md:flex-row">

        
            <div class="w-full md:w-1/2">
                <h1 class="text-4xl text-center font-bold text-gray-800">
                    <?php echo $blogTitle; ?>
                </h1>
                <!-- <div class="w-full md:w-1/2">
                <img src="https://images.unsplash.com/photo-1518791841217-8f162f1e1131?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" alt="">
            </div> -->
                <p class="mt-4 text-gray-600">
                    <?php echo $blogCreated; ?>
                </p>
                <p class="text-gray-600">
                    <?php echo $categoryLabel; ?>
                </p>
                <p class="border-1  mt-5 text-2xl text-gray-600">
                    <?php echo $blogContent; ?>
                </p>
            </div>
         
        </div>

        <!--create a comment box-->
        <div class="mt-6 flex flex-col md:flex-row">
            <div class="w-full md:w-1/2">
                <h1 class="text-2xl font-bold text-gray-800">
                    Leave a comment
                </h1>
                <form action="process/createComment.php" method="post">
                    <input type="hidden" name="blogid" value="<?php echo $blogid; ?>">
                    <input type="hidden" name="blogTitle" value="<?php echo $blogTitle; ?>">
                    <input type="hidden" name="blogCreated" value="<?php echo $blogCreated; ?>">
                    <input type="hidden" name="categoryLabel" value="<?php echo $categoryLabel; ?>">
                    <input type="hidden" name="blogContent" value="<?php echo $blogContent; ?>">
                    <div class="mt-4">
                        <label for="comment" class="text-gray-600">Comment</label>
                        <textarea name="comment" id="comment" cols="30" rows="10" class="border-1 w-full"></textarea>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">
                            Submit
                        </button>
                    </div>

                    <!--if comment is present in $_GET then show success comment was added-->
                    <?php if(isset($_GET['comment']) && $_GET['comment']=='success'){ ?>
                        <div class="mt-4">
                            <p class="text-green-500">
                                Comment added successfully
                            </p>
                        </div>
                    <?php } ?>


                </form>
            </div>

            <!--show comments-->
            <div class="w-full md:w-1/2">
                <h1 class="text-2xl font-bold text-gray-800">
                    Comments (<?php echo count($comments); ?>)
                </h1>
                <?php foreach($comments as $comment){ ?>
                    <div class="mt-4">
                        <p class="text-gray-600">
                            <?php echo $comment['value']; ?>
                        </p>
                        <p class="text-gray-600">
                            <?php echo $comment['created']; ?>
                        </p>
                    </div>
                <?php } ?>


        </div>
    
</body>
</html>