
<?php
    session_start();
    if(isset($_SESSION['email'])) {
        header("location:../game2.php");
    }
?>





<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astroxtellar/Signup</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Irish Grover', cursive;
            background-image: url("../imgs/ss.jpg");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .logo {
            text-align: center;
            position: absolute;
            top: 15%; 
            left: 55%;
            transform: translateX(-50%);
            width: 100%;
        }

        .caption {
            font-size: 4rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px #0000001b;
            animation: fadeIn 1s ease-in-out;
            font-family: 'Irish Grover', cursive;
            text-align: center;
            margin-right: 150px;
            margin-top: -20px;
            background: linear-gradient(135deg, #FF007F, #7F00FF, #00CFFF, #FFC926, #FF6B00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            background: #ffffff35;
            border-radius: 15px;
            box-shadow: 0 8px 32px #00bfff;
            padding: 20px;
            animation: slide-up 1s ease-out;
            margin-top: 110px;
            backdrop-filter: blur(15px); 
            -webkit-backdrop-filter: blur(15px); 
            border: 1px solid #ffffff74;
            margin-bottom: 5px;
        }

        h2 {
            text-align: center;
            color: #9c00f7;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #dddddd80;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #7F00FF, #FFC926);
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: linear-gradient(135deg, #ff8400, #FFC926);
            color: #000000;
        }

        .switch {
            text-align: center;
            margin-top: 20px;
        }

        .switch a {
            color: #7F00FF;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .switch a:hover {
            color: #FFC926;
        }

        input:focus {
            border-color: #7F00FF;
            box-shadow: 0 0 10px rgba(127, 0, 255, 0.5);
        }

        button:active {
            transform: scale(0.98);
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Social Login Container */
        .social-login {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        /* Shared Button Styles */
        .google-btn, .github-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 280px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        /* Google Button Specific Styles */
        .google-btn {
            background-color: #fff;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .google-btn:hover {
            background-color: #000000;
        }

        /* GitHub Button Specific Styles */
        .github-btn {
            background-color: #333;
            color: #000000;
        }

        .github-btn:hover {
            background-color: #444;
        }

        /* Icon Styles for Both Buttons */
        .google-icon {
            width: 20px;
            height: 20px;
        }

        .github-btn i {
            font-size: 18px;
        }

        /* Mobile-specific styles */
        @media screen and (max-width: 768px) {
            body {
                background-image: url("../imgs/mob copy.jpg"); /* You can change the mobile background image */
                background-size: cover;
                background-position: center;
            }

            .logo {
                top: 10%;
                left: 50%;
                transform: translateX(-50%);
            }

            .auth-container {
                margin-top: 5%;
                padding: 15px;
            }

            .caption {
                font-size: 2rem; /* Adjust caption size */
                margin-top: -10px;
                margin-right: 0;
            }

            h2 {
                font-size: 1.5rem; /* Adjust heading size for mobile */
            }

            input, button {
                padding: 12px; /* Adjust padding for input and button */
            }

            .social-login {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="logo">
        <h1 class="caption">Welcome to AstroXtellar</h1>
    </div>
    
    <div class="auth-container">
        <div class="auth-form">
            <h2>Sign Up</h2>
            <form action="../Backend/signup.php" method="POST">
                <input type="text" placeholder="Username" name="username" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit">Sign Up</button>
                <p class="switch">Already have an account? <a href="../Frontend/login.php">Login</a></p>
            </form>
            <div class="social-login">
                <button class="google-btn" onclick="googleLogin()">
                    <img src="../imgs/google.png" alt="Google Icon" class="google-icon"> Sign up with Google
                </button>
                <button class="github-btn" onclick="githubLogin()">
                    <i class="fab fa-github"></i> Sign up with GitHub
                </button>
            </div>
        </div>
    </div>
    
    <script>
        function googleLogin() {
            // Redirect or call Google SignIn API
        }

        function githubLogin() {
            // Redirect or call GitHub SignIn API
        }
    </script>
</body>
</html>
