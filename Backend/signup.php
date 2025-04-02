<?php
require 'Database/connect.php';
require 'Database/auth.php';
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_password = $_POST['password']; 

    // Check if email already exists in the database
    $emailCheckQuery = "SELECT * FROM Astrox WHERE email = ?";
    $stmt = $conn->prepare($emailCheckQuery);
    $stmt->bind_param("s", $user_email);// sql injection prevent method i used here......................
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Email Already Exists',
                text: 'This email address is already registered. Please use a different email or try logging in.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
        });
              </script>";
        $stmt->close();
    } else {
        try {
             // Insert user data into the database securely
            // Save user data to MySQL
            $uid = uniqid('user_', true); // Generate a unique ID
            $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Astrox (uid, username, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $uid, $user_name, $user_email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Account Created!',
                                text: 'Your account has been created successfully!',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '../Frontend/login.php';
                            });
                        });
                      </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Error creating account. Please try again.'
                            }).then(() => {
                                window.history.back();
                            });
                        });
                      </script>";
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: '" . $e->getMessage() . "'
                        });
                    });
                  </script>";
        }
    }

    $conn->close();
}
?>