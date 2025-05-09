<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');


$dsn = 'mysql:host=sql109.infinityfree.com;dbname=if0_38904826_alex_blog'; // Use correct database host
$username = 'if0_38904826';
$password = 'cIdbgiKR0eD';

try{
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo json_encode(['status' => 'success', 'message' => 'Server is connected']);

} catch(PDOException $e){
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $e->getMessage()]);

};