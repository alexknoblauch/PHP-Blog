<?php
header('Content-Type: application/json');


header('Access-Control-Allow-Origin: *');  // Allows all domains, adjust for production
header('Access-Control-Allow-Headers: Content-Type');  // Allow Content-Type header
header('Content-Type: application/json');  // Specify that the response is in JSON format


$dsn = 'mysql:host=sql109.infinityfree.com;dbname=if0_38904826_alex_blog'; // Use correct database host
$username = 'if0_38904826';
$password = 'cIdbgiKR0eD';
$charset = 'utf8mb4';


$options = [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch as associative arrays
PDO::ATTR_EMULATE_PREPARES => false, // Use native prepared statements
];

try {
$pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
 json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
exit; // Ensure to exit after sending the response
}
try {
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = :id");
    $stmt->execute([':id' => $id]);  // Assuming $id contains the value
    $blogPost = $stmt->fetch(PDO::FETCH_ASSOC);

    // Wrap the status message and the blogs array in a single object
    $response = [
        'status' => 'success',
        'message' => "Server is connected",
        'data' => $blogs
    ];

    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}