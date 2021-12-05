<?php

/***
 * This file is used to setup the database, and populate categories if its the first time
 */

 include_once('./includes/connect.php');

    //CREATE TABLES
    $sql_tables= file_get_contents('./sql/table.sql');

    //insert the tables with pdo
    $conn->exec($sql_tables);






?>