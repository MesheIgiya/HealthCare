<?php
include 'connect_db.php';
session_start();
$_SESSION["has_login"] = false;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $response = [
        'success' => false,
        'error' => 'Invalid username or password.'
    ];
    
    if ($username && $password) {
        $stmt = $conn->prepare('SELECT * FROM patients WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["user_id"] = $row['id'];
                $_SESSION["has_login"] = true;
                $response['success'] = true;
                $response['error'] = '';
            }
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405);
}


?>