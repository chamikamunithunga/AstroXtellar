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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Space Background with Stars */
        body {
            background-image: url("imgs/gamebg.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            overflow: hidden;
            
        }
        .glassy-box {
    width: 80%;
    max-width: 1200px;
    height: 600px;
    padding: 50px;
    background: #ffffff1a;
    border-radius: 15px;
    box-shadow: 0 4px 10px #ffffff33;
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 2px solid #ffffff4d;
    text-align: center;
    color: white;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin-top: 50px;
}

.next-button {
    position: absolute;
    bottom: 20px;
    right: 20px;
    padding: 12px 25px;
    font-size: 18px;
    font-weight: bold;
    color: white;
    background: linear-gradient(45deg, #ff0000, #6400e6);
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.next-button:hover {
    background: linear-gradient(45deg, #6400e6, #ff0000);
    transform: scale(1.1);
}




        .glassy-box h2 {
            font-size: 32px;
            margin-bottom: 10px;
            font-family: 'Irish Grover', cursive;
            background: linear-gradient(45deg, #ff0000, #6400e6);
            border-radius: 50%;
        }

        .glassy-box p {
            font-size: 18px;
            line-height: 1.5;
        }
        .glassy-box ul {
            text-align: left;
            margin-top: 20px;
            font-size: 18px;
            line-height: 1.5;
        }
        .glassy-box h3 {
    font-size: 24px;
    margin-top: 20px;
    font-family: 'Irish Grover', cursive;
    background: linear-gradient(-20deg, #ff0000, #00ff22, #e6009d, #006de1);
    background-size: 300% 300%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientAnimation 5s infinite alternate;
}

@keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}
.glassy-box h1 {
    font-size: 40px;
    margin-top: 20px;
    font-family: 'Irish Grover', cursive;
    background: linear-gradient(-20deg, #00ff22, #00ff22, #e17000, #4700e1);
    background-size: 300% 300%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientAnimation 5s infinite alternate;
    
}


        

       
        
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(-20deg, #ff0000, #948000, #6400e6, #006de1);
            background-size: 300% 300%;
            animation: gradientAnimation 10s ease infinite;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 2;
            border-bottom: 3px solid rgba(0, 0, 0, 0); 
            
        }

        @keyframes gradientAnimation {
            0% { background-position: 20% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .navbar h1 {
            color: #ffffff;
            font-size: 40px;
            font-family: 'Irish Grover', cursive;
        }

        .nav-links {
           display: flex;
           list-style: none;
           gap: 20px;
        }

        .nav-links li {
            padding: 10px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .nav-links a:hover {
            color: #00ccff;
        }

        



        







    </style>
</head>
<body>

    
    

    <div class="stars"></div>

    <div class="navbar">
        <div class="logo">
            <h1>AstroXteller</h1>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="./Frontend/explore.php">Explore</a></li>
            <li><a href="./Frontend/about.php">About Us</a></li>
            <li><a href="profile.php">profile</a></li>
        </ul>
    </div>

    <div class="glassy-box">
        <h2>Welcome to AstroXteller</h2>
        <p>Prepare for an interstellar challenge where only the sharpest minds can navigate the cosmos! Answer wisely, as your journey through the stars is filled with cosmic tests of knowledge and logic.!</p>
        <h3>Game Overview</h3>
        
            <ul>
                <li>The game consists of 10 questions in total.</li>
                <li>After answering the first 7 questions, you will face the Final Galactic Gate – a math challenge to test your problem-solving skills.</li>
                <li>If you answer correctly, you can proceed to the last 3 questions to complete your journey!</li>
                <li>If you fail the math challenge, you must reattempt it, but beware—your points will be reduced!</li>
            </ul>

            <h3>Game Rules</h3>
            <p>Every question matters – each correct answer brings you closer to victory,The Final Galactic Gate (7th question) is a math-based challenge—solve it correctly to move forward.One wrong answer at the Gate? You’ll have to retry the challenge with a points penalty.The last 3 questions unlock only,Reach the end with the highest points possible and become a true AstroXtellar Champion!</p>
            <h1>Are you ready to explore the cosmic mysteries and conquer AstroXtellar?</h1>
        

            <button class="next-button" onclick="goToNextPage()">Next →</button>

            <script>
                function goToNextPage() {
                    window.location.href = "Frontend/video.php"; 
                }
            </script>
            

    </div>
    </div>
</body>
</html>

   
     
    

    

 
    

    
       
        
        
        
    