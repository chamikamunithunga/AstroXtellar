<?php
http_response_code(404); // Set HTTP response status to 404
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-image: url("imgs/404.jpg");
            background-size: cover;
            background-position: center;
            
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            color: #fff;
            padding: 80px;
        }
        
        
        .btn {
    padding: 20px 24px;
    background: linear-gradient(45deg, #2600ff, #ffffff); /* Two-tone gradient */
    color: #000000;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
    text-decoration: none;
    display: inline-block;
    font-weight: bold;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow */
}

.btn:hover {
    background: linear-gradient(45deg, #2600ff, #00a2ff); 
}

    </style>
</head>
<body>

    
    
    <a href="index.php" class="btn">Go Back to Home</a>
</body>
</html>
