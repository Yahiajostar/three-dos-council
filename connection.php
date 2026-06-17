<?php

$host = "localhost";
$DB = "db";
$user = "root";
$pass = "";

try {

    $connection = new PDO(
        "mysql:host=$host;dbname=$DB",
        $user,
        $pass
    );

    $connection->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch(PDOException $e){

    echo $e->getMessage();
}