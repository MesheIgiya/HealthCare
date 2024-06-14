<?php

session_start();

$_SESSION = [];
$_SESSION['has_login_doctor'] = false;
session_destroy();

// Redirect the user to the login page (or any other page as needed)
echo json_encode(true);
exit();
?>