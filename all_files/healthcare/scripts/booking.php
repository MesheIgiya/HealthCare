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
    $patient_firstname = $_POST['patient_firstname'] ?? '';
    $patient_lastname = $_POST['patient_lastname'] ?? '';
    $patient_address = $_POST['patient_address'] ?? '';
    $patient_phone_no = $_POST['patient_phone_no'] ?? '';
    $patient_booking_date = $_POST['patient_booking_date'] ?? '';

    $patient_name = $patient_firstname . ' ' . $patient_lastname;
    $patient_user_id = $_SESSION["user_id"];
    $status = 'PENDING';

    $response = [
        'success' => false,
        'error' => 'Error!'
    ];

    $sql = "INSERT INTO bookings (patient_user_id, patient_name, patient_phone_no, patient_address, patient_booking_date, status) VALUES (?, ?, ?, ?, ?, ?)";
        
    // Prepare the statement and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $patient_user_id, $patient_name, $patient_phone_no, $patient_address, $patient_booking_date, $status);
        
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