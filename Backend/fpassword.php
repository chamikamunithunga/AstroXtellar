<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../Backend/Database/connect.php';

// Initialize session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



// Send OTP function
function sendOTP($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'chamikamunithunga1215@gmail.com'; // Replace with your actual Gmail address
        $mail->Password = 'elzg miin yljm bsmp'; // Replace with your actual Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Content
        $mail->setFrom('chamikamunithunga1215@gmail.com', 'Astroxteller'); // Replace with your actual Gmail address
        $mail->addAddress($email);
        $mail->Subject = 'Password Reset OTP';
        $mail->Body = "Your OTP for password reset is: $otp\nThis OTP will expire in 10 minutes.";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Handle POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Request to send OTP
    if (isset($_POST["action"]) && $_POST["action"] == "send_otp") {
        $email = $_POST["email"];
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format!";
            exit;
        }
        
        // Check if email exists in database
        $stmt = $conn->prepare("SELECT uid FROM Astrox WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) {
            echo "Email not found in our records!";
            exit;
        }
        
        // Generate OTP
        $otp = rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));
        
        // Store OTP in session
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_otp'] = $otp;
        $_SESSION['reset_otp_expiry'] = $otp_expiry;
        
        // Send OTP to email
        if (sendOTP($email, $otp)) {
            echo "OTP sent to your email!";
        } else {
            echo "Failed to send OTP. Please try again.";
        }
        exit;
    }
    
    // Request to verify OTP and update password
    if (isset($_POST["action"]) && $_POST["action"] == "reset_password") {
        $otp = $_POST["otp"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];
        
        // Validate stored session data
        if (!isset($_SESSION['reset_otp']) || !isset($_SESSION['reset_email']) || !isset($_SESSION['reset_otp_expiry'])) {
            echo "Session expired. Please try again.";
            exit;
        }
        
        // Check if OTP has expired
        if (strtotime($_SESSION['reset_otp_expiry']) < time()) {
            echo "OTP has expired. Please request a new one.";
            exit;
        }
        
        // Verify OTP
        if ($_SESSION['reset_otp'] != $otp) {
            echo "Invalid OTP. Please try again.";
            exit;
        }
        
        // Check if passwords match
        if ($new_password != $confirm_password) {
            echo "Passwords do not match!";
            exit;
        }
        
        // Update password in database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];
        
        $stmt = $conn->prepare("UPDATE Astrox SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        
        if ($stmt->execute()) {
            // Clear session variables
            unset($_SESSION['reset_otp']);
            unset($_SESSION['reset_email']);
            unset($_SESSION['reset_otp_expiry']);
            
            echo "your password is successfully updated "; // Special flag for JavaScript to recognize success
        } else {
            echo "Failed to update password. Please try again.";
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            text-align: center;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #222;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
        }

        .forgot-password a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
            display: block;
            margin-top: 10px;
            cursor: pointer;
            transition: color 0.3s ease-in-out;
        }

        .forgot-password a:hover {
            color: #ff6600;
            text-decoration: underline;
        }

        .form-section {
            display: none;
            margin-top: 15px;
        }

        input {
            width: 90%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #fff;
            border-radius: 5px;
            background: #333;
            color: white;
        }

        button {
            background-color: #ffcc00;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: bold;
        }

        button:hover {
            background-color: #ff6600;
        }
        
        #message {
            margin-top: 10px;
            padding: 8px;
            border-radius: 5px;
        }
        
        .success {
            background-color: rgba(0, 128, 0, 0.2);
            color: #4CAF50;
        }
        
        .error {
            background-color: rgba(255, 0, 0, 0.2);
            color:rgb(152, 244, 54);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Password Reset</h2>
    
    <div id="emailForm" class="form-section" style="display: block;">
        <h3>Enter your email</h3>
        <input type="email" id="email" placeholder="Enter your email" required>
        <button onclick="sendOTP()">Send OTP</button>
    </div>
    
    <div id="otpForm" class="form-section">
        <h3>Enter OTP</h3>
        <input type="text" id="otp" placeholder="Enter OTP sent to your email" required>
        <input type="password" id="newPassword" placeholder="New Password" required>
        <input type="password" id="confirmPassword" placeholder="Confirm New Password" required>
        <button onclick="resetPassword()">Reset Password</button>
    </div>
    
    <p id="message"></p>
    
    <p class="forgot-password">
        <a href="../Frontend/login.php">Back to Login</a>
    </p>
</div>

<script>
    function showMessage(text, isError = false) {
        let messageBox = document.getElementById("message");
        messageBox.innerHTML = text;
        messageBox.className = isError ? "error" : "success";
    }

    function sendOTP() {
        let email = document.getElementById("email").value;

        if (email === "") {
            showMessage("Please enter your email.", true);
            return;
        }

        // Send OTP request to PHP
        fetch("<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "action=send_otp&email=" + encodeURIComponent(email)
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("OTP sent")) {
                document.getElementById("emailForm").style.display = "none";
                document.getElementById("otpForm").style.display = "block";
                showMessage(data);
            } else {
                showMessage(data, true);
            }
        })
        .catch(error => {
            showMessage("Error connecting to server!", true);
        });
    }

    function resetPassword() {
        let otp = document.getElementById("otp").value;
        let newPassword = document.getElementById("newPassword").value;
        let confirmPassword = document.getElementById("confirmPassword").value;
        
        if (otp === "" || newPassword === "" || confirmPassword === "") {
            showMessage("Please fill all fields.", true);
            return;
        }
        
        if (newPassword !== confirmPassword) {
            showMessage("Passwords do not match!", true);
            return;
        }
        
        // Send reset password request to PHP
        fetch("<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "action=reset_password&otp=" + encodeURIComponent(otp) + 
                  "&new_password=" + encodeURIComponent(newPassword) + 
                  "&confirm_password=" + encodeURIComponent(confirmPassword)
        })
        .then(response => response.text())
        .then(data => {
            showMessage(data, !data.includes("successfully"));
            if (data.includes("successfully")) {
                setTimeout(function() {
                    window.location.href = "../Frontend/login.php";
                }, 3000);
            }
        })
        .catch(error => {
            showMessage("Error connecting to server!", true);
        });
    }
</script>

</body>
</html>
