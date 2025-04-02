<?php
require '/Backend/Database/connect.php'; // Adjust path - added ../ at beginning

session_start();
if(!isset($_SESSION['email'])) {
    die("User not logged in");
}
$sessionemail = $_SESSION['email'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Check if file was uploaded without errors
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . '_' . $_FILES['image']['name']; // Add timestamp to avoid filename conflicts
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_dir = __DIR__ . "/uploads/"; // Use absolute path
        
        // Create directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $image_path = "uploads/" . $image_name; // Store relative path in database
        $full_path = $upload_dir . $image_name; // Full path for file upload
        if (move_uploaded_file($image_tmp, $full_path)) {
            // Save the image path in the database
            $sql = "UPDATE `Astroxteller`.`Astrox` SET profilepic = ? WHERE email = ?";
            $sql = "UPDATE `Astroxteller`.`Astrox` SET profilepic = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $image_path, $sessionemail);

            if ($stmt->execute()) {
                echo "Profile picture updated successfully!";
            } else {
                echo "Database Error: " . $stmt->error;
            }
        } else {
            echo "File upload failed. Error code: " . $_FILES['image']['error'] . ", Path: " . $full_path . ", Permissions: " . substr(sprintf('%o', fileperms($upload_dir)), -4);
        }
        }
    } else {
        echo "No file uploaded or file upload error: " . $_FILES['image']['error'];
    }


$conn->close();
?>
