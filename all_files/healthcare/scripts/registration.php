<?php
include 'connect_db.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Access form data sent via the AJAX request
    $first_name = $_POST['first_name'] ?? ''; 
    $last_name = $_POST['last_name'] ?? ''; 
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? ''; 
    $password = $_POST['password'] ?? '';

    // Perform server-side validation and processing
    // For example:
    $success = true;
    $response = [];

    // Validate the data (e.g., check for empty fields)
    if (empty($first_name) || empty($last_name) || empty($email) || empty($username) || empty($password)) {
        $success = false;
        $response['error'] = 'All fields are required.';
    }

    // Check if the email already exists in the database
    if ($success) {
        $sql = "SELECT * FROM patients WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Email already exists
            $success = false;
            $response['error'] = 'Username already exists.';
        }
    }

    // If validation passes and email does not exist, perform other operations (e.g., save data to database)
    if ($success) {
        // Hash the password
        $encrypted_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL query for inserting a new user
        $sql = "INSERT INTO patients (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";
        
        // Prepare the statement and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $first_name, $last_name, $email, $username, $encrypted_password);
        
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
    }

    // Send a JSON response back to the client
    header('Content-Type: application/json');

    echo json_encode($response);
} else {
    // Return a 405 Method Not Allowed status if the request method is not POST
    http_response_code(405);
}
?>
