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
            background: linear-gradient(-20deg, #000000, #b16400, #a07600, #000000);
            background-size: 300% 300%;
            animation: gradientAnimation 10s ease infinite;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 2;
            border-bottom: 3px solid rgba(0, 0, 0, 0); 
            capacity: 90;
            
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
             /* Make the content slightly transparent */
        }

        /* Large Image Before Video */
        .large-image {
            width: 100%;
            height: 700px;
            object-fit: cover;
            display: block;
            margin-bottom: 10px;
            
            border-radius: 40px;
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
    background: linear-gradient(to right, #ffaa00, #ff7700);
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
    background: linear-gradient(to right, #ff6600, #9d8e86);
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
    padding: 30px;
    background-image: url('../imgs/footerex.jpeg');
    background-size: cover;
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











       

.image-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);  /* Use 1fr instead of 2fr for more space for images */
    grid-gap: 40px;  /* Reduce the gap between images for a more compact layout */
    padding: 20px;   /* Add padding to the container */
    max-width: 1200px;
    margin: 0 auto;
    margin-bottom: 50px;
}

.image-item {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease;
    text-align: center;
    padding: 0; /* Remove padding to make the image take more space */
}

.image-item img {
    width: 100%;
    height: 100%;  /* Allow the image to fully take the height of the container */
    object-fit: cover;
    transition: opacity 0.3s ease;
}

.image-item:hover {
    transform: scale(1.1);  /* Slightly larger scale effect */
}

.image-item:hover img {
    opacity: 0.8;
}

.image-item .image-text {
    background-color: rgba(0, 0, 0, 0.6);
    color: #fff;
    padding: 10px;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    text-align: center;
    font-size: 20px; /* Increase text size */
    transition: opacity 0.3s ease;
    opacity: 0;
}

.image-item:hover .image-text {
    opacity: 1;
}

/* Responsive design */
@media (max-width: 768px) {
    .image-grid {
        grid-template-columns: repeat(2, 1fr);  /* Use 2 columns on medium-sized screens */
    }
}

@media (max-width: 480px) {
    .image-grid {
        grid-template-columns: 1fr;  /* Single column for small screens */
    }
}

.up-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #fbc101;  /* Button background color */
    color: rgb(0, 0, 0);
    border: none;
    padding: 15px;
    font-size: 24px;
    border-radius: 30%;
    cursor: pointer;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    display: none;  /* Initially hidden */
    z-index: 10;
}

.up-button:hover {
    
    background-color: #fbc101;  
}


.pdf {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    padding: 20px;
    border-radius: 10px;
    width: 80%;
    margin: 20px auto; 
    background: linear-gradient(to right, #0d0d2b, #3f51b5); 
    color: #ffffff; 
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5); 
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
    <div class="scroll-container">
        <div class="scroll-text">Astroxteller - The Ultimate Space Quiz!  &nbsp;  &nbsp; Can you answer the toughest space questions?  &nbsp;  &nbsp; Challenge yourself now! </div>
    </div>
    
    <img class="large-image" src="../imgs/explorebg.jpg" alt="Space Image">

    
    <div class="center-container">
        <button class="button" onclick="window.location.href='../Frontend/signup.php';">Get Started</button>
    </div>

    <div class="content">
        <p>Embark on an interstellar adventure with AstroXteller, the ultimate space exploration game! Space exploration pushes the boundaries of human knowledge and opens the door to infinite possibilities. By partnering with leading space companies and embracing cutting-edge technologies, we can unlock new frontiers, unravel the mysteries of the universe, and pave the way for groundbreaking discoveries. For me, it’s not just about exploring outer space, it’s about exploring new opportunities, inspiring innovation, and contributing to a future where humanity thrives beyond Earth. Let’s venture beyond the stars, together....</p>
    </div>

    <div class="image-grid">
        <div class="image-item" onclick="goToPage('https://www.nasa.gov/')">
            <img src="../imgs/nasa.jpg" alt="Image 1">
            <div class="image-text">NASA</div>
        </div>
        <div class="image-item" onclick="goToPage('https://www.spacex.com/')">
            <img src="../imgs/spacex.jpg" alt="Image 2">
            <div class="image-text">SPACEX</div>
        </div>
        <div class="image-item" onclick="goToPage('https://www.lockheedmartin.com/')">
            <img src="../imgs/lm.jpg" alt="Image 3">
            <div class="image-text">LOCKHEED MARTIN</div>
        </div>
        <div class="image-item" onclick="goToPage('https://www.blueorigin.com/')">
            <img src="../imgs/bo.jpg" alt="Image 4">
            <div class="image-text">BLUE ORIGIN</div>
        </div>
        <div class="image-item" onclick="goToPage('https://www.esa.int/')">
            <img src="../imgs/esa.jpg" alt="Image 1">
            <div class="image-text">EUROPEAN SPACE AGENCY</div>
        </div>
        <div class="image-item" onclick="goToPage('https://www.iafastro.org/')">
            <img src="../imgs/r.png" alt="Image 2">
            <div class="image-text">RUSSIAN SPACE AGENCY</div>
        </div>
        <div class="image-item" onclick="goToPage('https://www.cnsa.gov.cn/english/index.html')">
            <img src="../imgs/cnsa.png" alt="Image 3">
            <div class="image-text">CHINA NATIONAL SPACE AGENCY</div>
        </div>
        <div class="image-item" onclick="goToPage('https://www.isro.gov.in/')">
            <img src="../imgs/isro-2024-top-milestones-space-technology.jpg" alt="Image 4">
            <div class="image-text">INDIAN SPACE RESEARCH ORGANIZATION</div>
        </div>
    </div>

     <div class = "pdf">Exploring the vast domain of space research is both exciting and enriching. Here are some authoritative resources offering a wealth of information</div>

    <div class="image-grid">
        <div class="image-item" onclick="goToPage('https://www.apu.apus.edu/area-of-study/math-and-science/resources/why-should-we-explore-space/')">
            <img src="../imgs/why-explore-space.jpg" alt="Image 1">
            <div class="image-text">Why Should We Explore Space? What Are the Benefits for Us?</div>
        </div>
        <div class="image-item" onclick="goToPage('https://en.wikipedia.org/wiki/Journal_of_the_British_Interplanetary_Society?utm_source=chatgpt.com')">
            <img src="../imgs/Jbisdaedalus.JPG" alt="Image 2">
            <div class="image-text">Journal of the British Interplanetary Society</div>
        </div>
        
        <div class="image-item" onclick="goToPage('https://en.wikipedia.org/wiki/World_Is_Not_Enough_%28spacecraft_propulsion%29?utm_source=chatgpt.com')">
            <img src="../imgs/Water_Detected_at_High_Latitudes_on_the_Moon.jpg" alt="Image 4">
            <div class="image-text">World Is Not Enough (spacecraft propulsion)</div>
        </div>
        <div class="image-item" onclick="goToPage('https://pmc.ncbi.nlm.nih.gov/articles/PMC3277416/')">
            <img src="../imgs/12675-0309139465-450.jpg" alt="Image 1">
            <div class="image-text">Human Space Exploration The Next Fifty Years</div>
        </div>
       
    </div>


    <button id="upBtn" class="up-button">↑</button>


 
    

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

        function goToPage(page) {
            window.location.href = page;
        }
    


        // Get the button element
let upButton = document.getElementById("upBtn");

// Show the button when the user scrolls down 200px or more
window.onscroll = function () {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        upButton.style.display = "block"; // Show the button
    } else {
        upButton.style.display = "none"; // Hide the button
    }
};

// Scroll to the top when the button is clicked
upButton.onclick = function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
};


        </script>
        </body>
        </html>

        
        
        
    