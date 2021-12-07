<?php


include_once("./includes/connect.php");

$searchQuery=$_GET['search'];
$searchIn= $_GET['search_in'];//content or title


//search blog based on column from searchIn
if($searchIn=="content"){
    $query="SELECT *,categories.label as label FROM blog INNER JOIN categories ON blog.categoryid=categories.id  WHERE content LIKE '%$searchQuery%'";
}else{
    $query="SELECT *, categories.label as label FROM blog INNER JOIN categories ON blog.categoryid=categories.id WHERE title LIKE '%$searchQuery%'";
}

//use pdo binding value
$stmt=$conn->prepare($query);
$stmt->bindValue(':searchQuery',$searchQuery);
$stmt->execute();

$results= $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!--tailwind cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">

</head>
<body class="bg-gray-400">

    <h1 class="text-center text-5xl mt-6">
        Search Results
    </h1>


<div class="container mx-auto mt-5">
    <div class="flex justify-center">
        <div class="w-full max-w-sm">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="search.php" method="get">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="search">
                        Search
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="search" name="search" type="text" placeholder="Search">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="search_in">
                        Search In
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="search_in" name="search_in">
                        <option value="title">Title</option>
                        <option value="content">Content</option>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!--show all results -->
    <div class="flex flex-wrap">
        <?php foreach($results as $result): ?>
            <div class="w-full md:w-1/2 lg:w-1/3 p-3">
                <div class="bg-white rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                       <a href="viewBlog.php?id=<?php echo $result['id'];?>"> <div class="font-bold text-xl mb-2"><?php echo $result['title']; ?></div> </a>
                        <p class="text-gray-700 text-base"><?php echo $result['content']; ?></p>
                    </div>
                    <div class="px-6 py-4">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#<?php echo $result['label'];?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    
    
</body>
</html>