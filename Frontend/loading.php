<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroXteller</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap');

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("../imgs/loading.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            overflow: hidden;
            color: white;
            text-align: center;
        }

        .text-above {
            font-size: 24px;
            margin-bottom: 20px;
            color: #00ffd9; 
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .progress-container {
            width: 80%;
            max-width: 500px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #00ffd9;
            margin-bottom: 10px;
        }

        .progress-bar {
            width: 0%;
            height: 100%;
            background: #00ffd9;
            transition: width 0.3s ease-in-out;
        }

        .text-below {
            font-size: 16px;
            color: #00ffd9; 
        }
    </style>
</head>
<body>

    <div class="text-above">Welcome to Astroxtellar!</div> 

    <div class="progress-container">
        <div class="progress-bar" id="progress-bar"></div>
    </div>

    <div class="text-below" id="loading-text">Loading...</div> 

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let progressBar = document.getElementById("progress-bar");
        let loadingText = document.getElementById("loading-text");
        let width = 0;

        function updateProgress() {
            if (width >= 100) {
                clearInterval(interval);
                loadingText.textContent = "Loaded!";
                setTimeout(function() {
                    // Redirect to cate.php after a short delay
                    window.location.href = "../Frontend/cate.php";
                }, 500); // Delay to show "Loaded!" text before redirection
            } else {
                width += 5; // Increase progress
                progressBar.style.width = width + "%";
            }
        }

        let interval = setInterval(updateProgress, 300); 
    });
</script>


</body>
</html>
