<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroXteller - Select Category</title>
    <style>
        body {
            background-image: url("../imgs/game1bg.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            overflow: hidden;
            font-family: Arial, sans-serif;
            color: white;
        }

        .glassy-box {
            width: 90%;
            max-width: 700px;
            height: 400px;
            padding: 20px;
            background: #ffffff1a;
            border-radius: 15px;
            box-shadow: 0 4px 10px #ffffff33;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 2px solid #ffffff4d;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .glassy-box h2 {
            font-size: 32px;
            margin-bottom: 30px;
        }

        .glassy-box button {
            font-size: 20px;
            padding: 15px 30px;
            margin: 10px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.4);
            color: white;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .glassy-box button:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>

    <div class="glassy-box">
        <h2>Choose Game Category</h2>
        <button onclick="startGame('easy')">Easy</button>
        <button onclick="startGame('medium')">Medium</button>
        <button onclick="startGame('hard')">Hard</button>
    </div>

    <script>
        function startGame(category) {
            // Redirect to the game page with the selected category
            window.location.href = "../gamepage.php?category=" + category;
        }

        // gamepage.html script (example)






    </script>
</body>
</html>
