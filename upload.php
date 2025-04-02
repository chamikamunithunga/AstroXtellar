<?php
session_start();
include("connect.php"); // Database connection

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    die("User not logged in");
}

$user_id = $_SESSION['uid'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    $upload_dir = "uploads/"; // Folder to store profile pictures
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file = $_FILES["profilepic"];
    $file_name = basename($file["name"]);
    $file_tmp = $file["tmp_name"];
    $file_size = $file["size"];
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_types = array("jpg", "jpeg", "png", "gif");

    // Validate file type
    if (!in_array($file_type, $allowed_types)) {
        die("Invalid file type. Only JPG, JPEG, PNG & GIF allowed.");
    }

    // Check file size (limit to 2MB)
    if ($file_size > 2 * 1024 * 1024) {
        die("File too large. Maximum allowed size is 2MB.");
    }

    // Rename file to prevent conflicts
    $new_file_name = "profile_" . $user_id . "_" . time() . "." . $file_type;
    $file_path = $upload_dir . $new_file_name;

    // Move uploaded file to server
    if (move_uploaded_file($file_tmp, $file_path)) {
        // Update database
        $stmt = $conn->prepare("UPDATE Astrox SET profilepic = ? WHERE id = ?");
        $stmt->bind_param("si", $file_path, $user_id);

        if ($stmt->execute()) {
            echo "Profile picture updated successfully!";
        } else {
            echo "Error updating profile picture.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>