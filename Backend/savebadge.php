<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = "root"; // Change if necessary
$dbname = "Astroxteller";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Image details
$imageName = "badge_" . time() . ".png"; // Unique file name
$imagePath = "badges/" . $imageName;

// Move generated image to the folder (assuming it's in temporary location)
if (move_uploaded_file($_FILES["badge_image"]["tmp_name"], $imagePath)) {
    // Insert image link into database
    $sql = "INSERT INTO Astrox (badge) VALUES ('$imagePath')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Badge saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Failed to save the badge.";
}

$conn->close();
?>
