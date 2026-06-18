<?php

$host = "localhost";
$DB= "3dos_council";
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
?>
 

<?php
$host     = 'localhost';
$dbname   = '3dos_council';
$username = 'root';
$password = '';

try {
    $connection = new PDO( "mysql:host=$host;dbname=$dbname;", $username,$password );
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
