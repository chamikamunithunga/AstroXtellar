<?php
require 'Backend/Database/connect.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Fetch top 5 scores ordered from highest to lowest
$sql = "SELECT username, score FROM Astrox ORDER BY score DESC LIMIT 10";
$result = $conn->query($sql);

// Initialize leaderboard array
$leaderboard = [];

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Fetch results and store them in the leaderboard array
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
} else {
    // If no data is found, provide a default message in the leaderboard
    $leaderboard[] = ['username' => 'No data available', 'score' => 0];
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('imgs/game1bg.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        h2 {
            color: #fff;
            margin-top: 50px;
            font-size: 2.5rem;
        }

        .leaderboard-container {
            backdrop-filter: blur(10px); /* Apply blur effect */
            background-color: rgba(255, 255, 255, 0.3); /* Semi-transparent white for glossy effect */
            border-radius: 10px;
            padding: 20px;
            max-width: 80%;
            margin: 50px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #333;
            text-align: center;
        }

        th {
            background-color:rgb(0, 112, 217);
            color:rgb(197, 234, 241);
        }

        td {
            background-color: white;
        }

        @media (max-width: 768px) {
            table {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="leaderboard-container">
        <a href="profile.php" style="display: inline-block; background-color:rgb(0, 255, 251); color: #000000; padding: 10px 15px; margin-bottom: 20px; text-decoration: none; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">← Back to Home</a>
        <h2>🏆 Leaderboard</h2>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Max Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($leaderboard) > 0) {
                    foreach ($leaderboard as $index => $user) {
                        echo "<tr>
                                <td>" . ($index + 1) . "</td>
                                <td>" . htmlspecialchars($user['username']) . "</td>
                                <td>" . htmlspecialchars($user['score']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No scores available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>