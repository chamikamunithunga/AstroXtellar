<?php
    session_start();
    if(isset($_SESSION['email'])){
       $userState  = "Profile";
       $usernagivatelink = "../profile.php";
    }else{
        $userState = "Login";
        $usernagivatelink = "../Frontend/login.php";
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
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
            background: linear-gradient(-20deg,#0b00a9, #008ba0, #008b90, #006de1);
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
            z-index: 0;
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
            height: 900px;
            object-fit: cover;
            display: block;
            margin-bottom: 10px;
            opacity: 0.9;
            margin-bo: 20px;
        }

        /* Button Styling */
        .center-container {
    display: flex;
    justify-content: center;
    align-items: flex-start; 
    height: 5vh; 
    padding-top: 10px; 
}

.button {
    background: linear-gradient(to right, #00b3ff, #eaff00);
    color: #070324;
    padding: 12px 20px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    text-transform: uppercase;
    box-shadow: 0 5px 15px #0000001a;
    position: relative;
    z-index: 0;
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



/* Background Image - Full Width */
.image-container2 {
    position: relative;
    width: 100%;
    text-align: center;
    margin-top: 40px;
}

.large-image2 {
    width: 100%;
    height: 100vh;
    object-fit: cover;
    position: relative;
}

/* Centered Round Image */
.profile-image2 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 0;
}

.round-image2 {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 4px solid white;
    box-shadow: 0 4px 15px #ffffff;
    margin-bottom: 600px;
}

/* Description Box */
.image-description2 {
    position: absolute;
    bottom: 5%; 
    left: 50%;
    transform: translateX(-50%);
    color: white;
    padding: 30px; 
    width: 100%; 
    max-width: 1300px; 
    border-radius: 15px;
    margin-bottom: 150px; 
    font-family: 'Itim', sans-serif;
    font-size: 18px; 
    line-height: 1.6; 
    text-align: justify; 

}
        /* Footer Section */
        .footer {
    text-align: center;
    padding: 30px;
    background-image: url('../imgs/Fa.jpg');
    background-size: cover;
    background-position: center;
    background-position: center;

    color: #000000;
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
        <li><a href="../index.php">Home</a></li>
            <li><a href="../Frontend/explore.php">Explore</a></li>
            <li><a href="../Frontend/about.php">About Us</a></li>
            <li><a href="<?php echo $usernagivatelink; ?>" style="z-index: 10;"><?php echo $userState; ?></a></li>
        </ul>
    </div>

    <div class="content">
    <h1>AstroXtellar</h1>
    <p>AstroXtellar: Explore the Cosmos Like Never Before!</p>
</div>

<!-- Background Image Container -->
<div class="image-container2">
    <img class="large-image2" src="../imgs/aboutbg.jpg" alt="Space Image">

    <!-- Centered Round Image -->
    <div class="profile-image2">
        <img class="round-image2" src="../imgs/pic.jpeg" alt="Profile Image">
    </div>

    <!-- Description -->
    <div class="image-description2">
        <p>Hello, I'm Mr. Chamika Munithunga, the creator and developer of AstroXteller. This game is my contribution to inspiring and educating the next generation of space explorers, and it was born from my passion for space exploration and the importance of mental well-being for students.</p>
        <br>
        <p>AstroXteller isn’t just a game – it’s a journey into the heart of the universe designed to enhance space-related knowledge and ease the pressures students face. With each mission you embark upon, you’ll explore vast galaxies, uncover the mysteries of distant planets, and engage with unique alien civilizations. But there's more to it than just exploration: this game was crafted with the aim to help students alleviate stress while boosting their understanding of space science.</p>
        <br>
        <p>My background in technology and game development has allowed me to blend creative storytelling with technical precision, producing an immersive environment where players can engage with the wonders of space. I believe in the power of learning through play, and I’ve worked hard to ensure that Astroxteller offers a balance of educational value, excitement, and stress relief.

         Beyond the world of coding and space simulations, I’m dedicated to helping young minds find inspiration and a sense of wonder. Through Astroxteller, I hope to spark a love for space exploration and open up new opportunities for students to discover, learn, and grow.</p>
    </div>
</div>

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

        
        
        
    