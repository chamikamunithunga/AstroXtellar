<?php
session_start();
require 'Database/connect.php';



// Ensure $auth and $conn are initialized


// Handle Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Query the database to check if user exists
        $stmt = $conn->prepare("SELECT * FROM Astrox WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // If successful, save email to session and redirect
                $_SESSION['email'] = $email;
                
                $_SESSION['user_id'] = $user['uid'];
                echo "<script>
                        alert('Login Successful!');
                        window.location.href = '../index.php';
                      </script>";
                exit();
            } else {
                echo "<script>alert('Invalid password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('User not found. Please check your email or sign up.');</script>";
        }
        $stmt->close();
    } catch (Exception $e) {
        echo "<script>alert('Login error: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}

// Handle Signup
if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        

        // Save user data to MySQL (use prepared statements to prevent SQL injection)
        $uid = $user->uid; // Firebase UID
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password for MySQL

        // Prepared statement to prevent SQL injection
        $signupQuery = $conn->prepare("INSERT INTO users (uid, email, password) VALUES (?, ?, ?)");
        $signupQuery->bind_param("sss", $uid, $email, $hashed_password); // "sss" means three strings

        if ($signupQuery->execute()) {
            echo "<script>
                    alert('Account created successfully!');
                    window.location.href = 'Backend/login.php'; // Redirect to login page
                  </script>";
        } else {
            echo "<script>alert('Error creating account. Please try again.');</script>";
        }

        $signupQuery->close();
    } catch (Exception $e) {
        echo "<script>alert('Email already exists or invalid input.');</script>";
    }
}
?>