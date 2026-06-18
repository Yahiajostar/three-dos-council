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
