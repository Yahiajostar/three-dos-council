<?php
require_once __DIR__ . '/vendor/autoload.php';
use Predis\Client;
try {
    $redis = new Client([
        'scheme' => 'tcp',
        'host'   => '127.0.0.1',
        'port'   => 6379
    ]);
    
    $redis->ping(); 
    
} catch (Exception $e) {
    header("Content-Type: application/json");
    http_response_code(500);
    echo json_encode([
        "status" => 500,
        "message" => "Redis server is not running. Please start redis-server or Memurai."
    ]);
    exit();
}