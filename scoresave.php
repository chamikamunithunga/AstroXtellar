<?php
require 'Backend/Database/connect.php';
session_start();

if (!isset($_SESSION['email'])) {
    exit;
}

$session = $_SESSION;
$email = $session['email'];
// Get the score from the POST request
if (isset($_POST['correct-answers'])) {
    $userScore = $_POST['correct-answers'];
    $badge = isset($_POST['badge']) ? $_POST['badge'] : '';

    $query = "SELECT * FROM astrox WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // User exists, update the score
        $row = mysqli_fetch_assoc($result);
        $score = $row['score'];
        
        // Always update the score
        $updateQuery = "UPDATE astrox SET score = '$userScore' ,badge = '$badge' WHERE email = '$email'";
        mysqli_query($conn, $updateQuery);
        echo "Score updated successfully!";
    } else {
        // User doesn't exist, insert new record
        $insertQuery = "INSERT INTO astrox (email, score) VALUES ('$email', '$userScore')";
        mysqli_query($conn, $insertQuery);
        echo "Score saved successfully!";
    }
} else {
    // Handle the case where score is not set in the POST request
    echo "Score not provided";
    exit;
}


// Fetch the user's current score

?>
