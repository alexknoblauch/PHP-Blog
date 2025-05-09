<?php
session_start();

header('Access-Control-Allow-Origin: http://alexblog.infinityfreeapp.com');  // Allows all domains, adjust for production
header('Access-Control-Allow-Headers: Content-Type');  // Allow Content-Type header
header('Access-Control-Allow-Credentials: true');              // ✅ IMPORTANT

 

try{
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    echo json_encode([
        'success' => false,
        'message' => 'Connection failed: ' . $e->getMessage()
    ]);
    exit;
};


$data = json_decode(file_get_contents("php://input"), true);

// Check if email and password exist
if (!$data || empty(trim($data['email'])) || empty(($data['password']))) {
    // Send error if either email or password is empty
    echo json_encode(['success' => false, 'message' => 'Email and password are required']);
    exit; // Exit after sending the response
}

$email = $data['email'];
$password = $data['password'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if ($user) {
    try {
        // Verify the password (using the password stored in the database and the input password)
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
            ];

            echo json_encode(['success' => true, 'message' => 'User logged in'   ,      'session' => $_SESSION // This will include the entire session data in the response
        ]);
            exit; // Ensure to exit after sending the response
        } else {
            // If password doesn't match
            echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            exit; // Ensure to exit after sending the response
        }
    } catch (Exception $e) {
        // Catch any exception during password verification
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        exit; // Ensure to exit after sending the response
    }
} else {
    // If no user was found with the email
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit; // Ensure to exit after sending the response
}


session_start();
header('Access-Control-Allow-Origin: https://www.akwebdesign.ch');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');



$dsn = 'mysql:host=localhost,dbname=alex_db';
$username = 'root';
$password = '';

try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE);
} catch(PDOException $e){
    echo json_encode(['success' => false, 'message' => 'DB connection failed' . $e->getMessage()]);
}

$stmt = $pdo->prepare('EXPORT * FROM users WHERE username = :username');
$user = $pdo->execute(['username' => $username]);


$data = json_decode(file_get_contents('php://input'));

if(password_verify($user['password'], $password)){
    $_SESSION['user']
}