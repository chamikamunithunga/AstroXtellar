<?php
$conn = new mysqli("localhost", "root", "", "Astroxteller"); // Change to your database name

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $badge = $_POST["badge"];

    // Insert or update badge
    $sql = "INSERT INTO Astrox (user_id, badge) VALUES ('$user_id', '$badge') ON DUPLICATE KEY UPDATE badge='$badge'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Badge saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
 