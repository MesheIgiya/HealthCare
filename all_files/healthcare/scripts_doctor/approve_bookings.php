<?php
include 'connect_db.php';
session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $action = $_POST['action'] ?? '';

    $doctor = '';
    if($action == 'APPROVE'){
        $status = 'APPROVED';
        $doctor = 'Dr. ' . $_SESSION["user_doctor_fullname"]; 
    }
    else if($action == 'DISAPPROVE'){
        $status = 'DISAPPROVED';
    }
    else{
        $response = [
            'success' => false,
            'error' => 'Error!'
        ];
    }


    $response = [
        'success' => false,
        'error' => 'Error!'
    ];

    $sql = "UPDATE bookings SET status='$status', doctor='$doctor' WHERE id = '$id'";
        
    // Prepare the statement and bind parameters
    $stmt = $conn->prepare($sql);
        
    // Execute the query
    $result = $stmt->execute();
        
    // Check the result and update the response
    $response['success'] = $result;

    // If the operation was successful, set the success flag to true
    if ($result) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }

    // Close the prepared statement
    $stmt->close();
    
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405);
}


?>