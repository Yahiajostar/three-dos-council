<?php
$host = "localhost";
$DB = "3dos_council";
$user = "root";
$pass = "";
try {
    $connection = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $user,
        $pass
    );
    $connection->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>