<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: ../Frontend/login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "root";  // Replace with your database password
$dbname = "Astroxteller";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['uid'];
$message = "";
$errorMsg = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = trim($_POST['username']);
    $newPassword = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    
    // Validation
    if (empty($newUsername)) {
        $errorMsg .= "Username cannot be empty.<br>";
    }
    
    if (!empty($newPassword) && $newPassword != $confirmPassword) {
        $errorMsg .= "Passwords do not match.<br>";
    }
    
    // If no errors, proceed with update
    if (empty($errorMsg)) {
        // Start with the base query
        $query = "UPDATE users SET ";
        $updates = [];
        $params = [];
        
        // Add username to the update
        $updates[] = "username = ?";
        $params[] = $newUsername;
        
        // Add password to the update if provided
        if (!empty($newPassword)) {
            $updates[] = "password = ?";
            $params[] = password_hash($newPassword, PASSWORD_DEFAULT);
        }
        
        // Handle file upload
        if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] == 0) {
            $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
            $filename = $_FILES['profilepic']['name'];
            $filetype = $_FILES['profilepic']['type'];
            $filesize = $_FILES['profilepic']['size'];
            
            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) {
                $errorMsg .= "Please select a valid file format (JPG, JPEG, PNG, GIF).<br>";
            }
            
            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if ($filesize > $maxsize) {
                $errorMsg .= "File size is larger than 5MB.<br>";
            }
            
            // If no errors, proceed with upload
            if (empty($errorMsg)) {
                // Create upload directory if it doesn't exist
                $upload_dir = "uploads/";
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Generate unique filename
                $new_filename = uniqid() . "." . $ext;
                $upload_path = $upload_dir . $new_filename;
                
                if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $upload_path)) {
                    $updates[] = "profilepic = ?";
                    $params[] = $upload_path;
                } else {
                    $errorMsg .= "There was an error uploading your file.<br>";
                }
            }
        }
        
        // If there are updates and no errors
        if (!empty($updates) && empty($errorMsg)) {
            $query .= implode(", ", $updates);
            $query .= " WHERE uid = ?";
            $params[] = $userId;
            
            $stmt = $conn->prepare($query);
            
            // Create the types string for bind_param
            $types = str_repeat("s", count($params));
            
            // Dynamically bind parameters
            $stmt->bind_param($types, ...$params);
            
            if ($stmt->execute()) {
                $message = "Account updated successfully!";
            } else {
                $errorMsg = "Error updating account: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Get current user info
$stmt = $conn->prepare("SELECT username, profilepic FROM Astrox WHERE uid = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $currentUsername = $row['username'];
    $currentProfilePic = $row['profilepic'];
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Update Account</h1>
    
    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <?php if (!empty($errorMsg)): ?>
        <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
    <?php endif; ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($currentUsername); ?>">
        </div>
        
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password">
            <small>(Leave blank to keep current password)</small>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password">
        </div>
        
        <div class="form-group">
            <label>Current Profile Picture:</label>
            <?php if (!empty($currentProfilePic) && file_exists($currentProfilePic)): ?>
                <img src="<?php echo htmlspecialchars($currentProfilePic); ?>" class="profile-pic" alt="Profile Picture">
            <?php else: ?>
                <p>No profile picture set</p>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="profilepic">Update Profile Picture:</label>
            <input type="file" name="profilepic" id="profilepic">
            <small>Allowed formats: JPG, JPEG, PNG, GIF (Max size: 5MB)</small>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Update Account">
        </div>
    </form>
    
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>