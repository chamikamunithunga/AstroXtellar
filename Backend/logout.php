<?php

session_start();
// Get the request payload
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Initialize response
$response = ['success' => false];

// Check if the logout parameter is set and true
if (isset($data['logout']) && $data['logout'] === true) {
    // Unset all session variables
    $_SESSION = [];
    
   
    
    // Destroy the session
    session_destroy();
    
    $response['success'] = true;
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
