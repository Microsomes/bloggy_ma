<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    include_once("../includes/connect.php");


    $query= $_GET['query'];
    $columns= explode(",",$_GET['columns']);



    //try to catch

    try{

    //search blog based on columns pdo
    $sql = "SELECT * FROM blog WHERE ";
    $i=0;
    foreach($columns as $column){
        if($i==0){
            $sql.= $column." LIKE '%".$query."%'";
        }else{
            $sql.= " OR ".$column." LIKE '%".$query."%'";
        }
        $i++;
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
}
catch(PDOException $e){
    //echo $e->getMessage();
    echo json_encode(array("error"=>$e->getMessage()));
}




?>

