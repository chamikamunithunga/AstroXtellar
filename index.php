<?php
    session_start();
    if(isset($_SESSION['email'])){
       $userState  = "Profile";
       $usernagivatelink = "profile.php";
    }else{
        $userState = "Login";
        $usernagivatelink = "Frontend/login.php";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroXtellar</title>
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
            background: black;
            
            position: relative;
        }


        
        .scroll-container {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
            margin-top: 30px;
            background: rgba(0, 0, 0, 0);
            padding: 10px 0;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            
        }


        .scroll-text {
            display: inline-block;
            font-size: 2em;
            animation: scroll 10s linear infinite;
            background: linear-gradient(90deg, purple, yellow,#00b0e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        @keyframes scroll {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }

        /* Fullscreen Background Video */
        video.background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; 
        }

        .stars {
            position: fixed;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/stardust.png') repeat;
            animation: starAnimation 70s linear infinite;
        }

        @keyframes starAnimation {
            from { background-position: 0 0; }
            to { background-position: -10000px 5000px; }
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

        /* Big Title and Caption */
        .content {
            text-align: center;
            padding: 40px;
            position: relative;
            color: white;
        }

        .content h1 {
            font-size: 50px;
            font-family: 'Irish Grover', cursive;
            margin-bottom: 10px;
            color: #FFC926;
        }

        .content p {
            font-size: 28px;
            color: #01CFFB;
            padding: 20px;
            font-family: 'Itim', sans-serif;
            opacity: 0.8; /* Make the content slightly transparent */
        }

        /* Large Image Before Video */
        .large-image {
            width: 100%;
            height: 600px;
            object-fit: cover;
            display: block;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        /* Button Styling */
        .center-container {
    display: flex;
    justify-content: center;
    align-items: flex-start; 
    height: 5vh; 
    padding-top: 20px; 
    
}

.button {
    background: linear-gradient(to right, #00b3ff, #eaff00);
    color: #070324;
    padding: 12px 30px;
    font-size: 22px;
    font-weight: bold;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    text-transform: uppercase;
    box-shadow: 0 5px 15px #0000001a;
    position: relative;
    pointer-events: auto;
    
    

}

.button:hover {
    background: linear-gradient(to right, #ae00ff, #0033ff);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.button:focus {
    outline: none;
    box-shadow: 0 0 5px #FFC926;
}

.button:active {
    transform: translateY(2px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}


        /* Image Gallery */
        .image-gallery {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            margin-left: 60px;
        }

        .image-gallery img {
            width: 70%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .image-caption {
            text-align: center;
            color: #00f2ff;
            margin-top: 5px;
            margin-right: 80px;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 80px;
            
        }
         /* Player Section */
         .player {
    text-align: center;
    margin-top: 40px;
}

.player p {
    font-size: 40px;
    background: linear-gradient(to right, #fbff00, #ff6a00); 
    -webkit-background-clip: text; 
    color: transparent; 
    margin-bottom: 20px;
    font-family: 'Irish Grover', cursive;
}


.image-container {
    display: flex;
    justify-content: center; 
    gap: 20px; 
}

.image-item {
    text-align: center;
}

.image-item img {
    width: 300px; 
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.image-caption1 {
    margin-top: 10px;
    color: #00fffb;
    font-size: 18px;
    font-weight: bold;
    margin-right: 10px;
    font-style: italic;
    margin-bottom: 80px;

}


        /* Footer Section */
        .footer {
    text-align: center;
    padding: 60px;
    background-image: url('imgs/footer.jpg');
    background-size: cover;
    background-position: center;
    color: #ffffff;
    position: relative;
    
}

.footer p {
    margin: 10px 0;
}

.footer a {
    margin: 0 5px;
    font-size: 30px; /* Icon size */
    transition: transform 0.3s ease;
}

.footer a:hover {
    transform: scale(1.1);
}

/* Colored Icons */
.footer a:nth-child(1) i {
    color: #ff0066;
}

.footer a:nth-child(2) i {
    color: #0011ff; 
}

.footer a:nth-child(3) i {
    color: #003c75; 
}

/* Change icon color on hover */
.footer a:hover i {
    color: #ffffff; 
}



    </style>
</head>
<body>

    <!-- Background Video -->
    

    <div class="stars"></div>

    <div class="navbar">
        <div class="logo">
            <h1>AstroXtellar</h1>
        </div>
        <ul class="nav-links">

            <li><a href="#">Home</a></li>
            <li><a href="./Frontend/explore.php">Explore</a></li>
            <li><a href="./Frontend/about.php">About Us</a></li>
            <li><a href="<?php echo $usernagivatelink; ?>" style="z-index: 10;"><?php echo $userState; ?></a></li>
        </ul>
    </div>

    <div class="content">
        <h1>AstroXtellar</h1>
        <p>AstroXtellar: Explore the Cosmos Like Never Before!</p>
    </div>

    <div class="scroll-container">
        <div class="scroll-text">Astroxteller - The Ultimate Space Quiz!  &nbsp;  &nbsp; Can you answer the toughest space questions?  &nbsp;  &nbsp; Challenge yourself now! </div>
    </div>

    <img class="large-image" src="imgs/bg.jpg" alt="Space Image">

    <div class="center-container">
        <button class="button" onclick="window.location.href='Frontend/signup.php';">Let's Play</button>
    </div>

    <div class="content">
        <p>Embark on an interstellar adventure with AstroXteller, the ultimate space exploration game! Space exploration pushes the boundaries of human knowledge and opens the door to infinite possibilities. By partnering with leading space companies and embracing cutting-edge technologies, we can unlock new frontiers, unravel the mysteries of the universe, and pave the way for groundbreaking discoveries. For me, it’s not just about exploring outer space, it’s about exploring new opportunities, inspiring innovation, and contributing to a future where humanity thrives beyond Earth. Let’s venture beyond the stars, together.</p>
    </div>

    <div class="image-gallery">
        <div onclick="openModal('Nebulae Wonders')">
            <img src="imgs/1.png" alt="Space Image 1">
            <div class="image-caption">Nebulae Wonders</div>
        </div>
        <div onclick="openModal('Galaxy Views')">
            <img src="imgs/2.png" alt="Space Image 2">
            <div class="image-caption">Galaxy Views</div>
        </div>
        <div onclick="openModal('Cosmic Beauty')">
            <img src="imgs/3.png" alt="Space Image 3">
            <div class="image-caption">Cosmic Beauty</div>
        </div>
        <div onclick="openModal('Stellar Formation')">
            <img src="imgs/4.png" alt="Space Image 4">
            <div class="image-caption">Stellar Formation</div>
        </div>
        <div onclick="openModal('Asteroids in Orbit')">
            <img src="imgs/5.png" alt="Space Image 5">
            <div class="image-caption">Asteroids in Orbit</div>
        </div>
    </div>
    
    <!-- Modal (Pop-up Box) -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
        </div>
    </div>
    
    

    <div class="player">
        <p>Challenge yourself in single-player or multiplayer group mode.</p>
        <div class="image-container">
            <div class="image-item">
                <img src="imgs/single.png" alt="single">
                <div class="image-caption1">Single Player</div>
            </div>
            <div class="image-item">
                <img src="imgs/multiplayer.png" alt="multiplayer">
                <div class="image-caption1">Multiplayer</div>
            </div>
        </div>
    </div>
    

    <!-- Footer Section -->
        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for exploring with AstroXtellar. Stay tuned for more cosmic adventures!</p>
            <div>
                <p>Follow us on:</p>
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            <p>&copy; 2025 AstroXtellar. All rights reserved.</p>
        </div>

        <script>
            function openModal(title, imgSrc, gifSrc) {
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalImage").src = imgSrc;
    document.getElementById("modalGif").src = gifSrc;
    document.getElementById("imageModal").style.display = "flex";
}

function closeModal() {
    document.getElementById("imageModal").style.display = "none";
}

        </script>
        </body>
        </html>

        
        
        
    