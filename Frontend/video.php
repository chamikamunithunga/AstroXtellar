<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullscreen Video</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; }
        .video-container { position: relative; width: 100vw; height: 100vh; }
        video { width: 100%; height: 100%; object-fit: cover; }
        .controls { position: absolute; bottom: 20px; left: 20px; color: white; }
        .skip-btn { 
            position: absolute; 
            bottom: 35px;
            right: 30px;
            display: none; 
            padding: 10px 20px; 
            font-size: 18px; 
            background: red; 
            color: white; 
            border: none; 
            border-radius: 4px;
            cursor: pointer; 
        }
    </style>
</head>
<body>
    <div class="video-container">
        <video id="video" autoplay>
            <source src="../imgs/0402.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="controls">
            <label>Volume :</label>
            <input type="range" id="volume" min="0" max="1" step="0.1" value="1">
        </div>
        <button id="skip" class="skip-btn">Skip</button>
    </div>

    <script>
        const video = document.getElementById("video");
        const volumeControl = document.getElementById("volume");
        const skipButton = document.getElementById("skip");
        
        // Function to navigate to the next page
        function goToNextPage() {
            window.location.href = "../Frontend/loading.php";
        }

        volumeControl.addEventListener("input", function() {
            video.volume = this.value;
        });

        // Show skip button after 20 seconds
        setTimeout(() => {
            skipButton.style.display = "block";
        }, 20000);

        // Navigate to next page when video ends
        video.addEventListener("ended", goToNextPage);

        // Skip button click event
        skipButton.addEventListener("click", goToNextPage);
    </script>
</body>
</html>
