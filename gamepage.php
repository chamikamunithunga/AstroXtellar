
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroXteller - Game</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap');
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-image: url("imgs/gamebg1.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        
        Google Identity Services API
        /* Glassy Box Styling */
        .glassy-box {
            background: #ffffff2b;
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 90%;
            max-width: 600px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        .glassy-box h3 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #57ffee;
        }

        /* Timer Styling */
        .timer {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #ff0000;
            font-weight: bold;
        }

        /* Question Box Styling */
        .question-box {
            font-size: 1.2rem;
            margin-bottom: 20px;
            background: #00e5ff33;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #ff00bfc0;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        /* Answer Buttons Styling */
        #answers {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .answer-button {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .answer-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .answer-button:active {
            transform: translateY(0);
            box-shadow: none;
        }

        /* Game Over Box Styling */
        .game-over-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 90%;
            max-width: 600px;
            text-align: center;
            display: none;
            animation: fadeIn 1s ease-in-out;
        }

        .game-over-box h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #ffdd57;
        }

        .game-over-box p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        /* Badge Styling */
        .badge {
            width: 100px;
            height: 100px;
            margin-top: 20px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        /* Social Media Sharing Buttons */
        .social-share {
            margin-top: 20px;
        }

        .social-share a {
            color: #fff;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-share a:hover {
            color: #57ffee;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .glassy-box, .game-over-box {
                width: 95%;
                padding: 20px;
            }

            .question-box {
                font-size: 1rem;
            }

            .answer-button {
                font-size: 0.9rem;
            }

            .timer {
                font-size: 1.2rem;
            }

            .game-over-box h2 {
                font-size: 1.5rem;
            }

            .game-over-box p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="glassy-box">
        <h3>AstroXteller</h3>
        <h2>Game - <span id="category-name"></span> Difficulty</h2>
        <div class="timer" id="timer">Time remaining: 7:00</div>
        <div class="question-box" id="question-box">Loading question...</div>
        <div id="answers">
            <!-- Answer options will be added dynamically -->
        </div>
    </div>

    <!-- Game Over Box -->
    <div class="game-over-box" id="game-over-box">
        <h2>Game Over!</h2>
        <p>Here's your score ;</p>
        <p>Correct Answers: <span id="correct-answers"></span></p>
        <p>Wrong Answers: <span id="wrong-answers"></span></p>
        <p>Total Questions: <span id="total-questions"></span></p>
        <!-- Badge Image -->
        <img id="badge" class="badge" src="" alt="Badge" style="display: none;">
        <!-- Badge Details -->
        <p id="badge-details" style="display: none;"></p>
        <!-- Social Media Sharing -->
        <div class="social-share">
    <p>Share your badge:</p>
    <a href="#" id="share-facebook" onclick="shareOnFacebook()">
        <i class="fab fa-facebook"></i>
    </a>
    <a href="#" id="share-instagram" onclick="shareOnInstagram()">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="#" id="share-linkedin" onclick="shareOnLinkedIn()">
        <i class="fab fa-linkedin"></i>
    </a>
    <div class="action-buttons" style="margin-top: 20px;">
        <button onclick="backToHome()" class="answer-button">
            <i class="fas fa-home"></i> Home
        </button>
        <button onclick="viewProfile()" class="answer-button">
            <i class="fas fa-user"></i> View Profile
        </button>
        <button onclick="restartGame()" class="answer-button">
            <i class="fas fa-redo"></i> Play Again
        </button>
    </div>

    <script>
        function backToHome() {
            window.location.href = 'index.php';
        }
        
        function viewProfile() {
            window.location.href = 'profile.php';
        }
        
        function restartGame() {
            window.location.href = 'gamepage.php?category=' + category;
        }
    </script>
</div>

    </div>

    <script>
        // Fetch the category from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const category = urlParams.get('category');
        const questions = {
            easy: [
                { question: "What is the closest planet to the Sun?", answers: ["Mercury", "Venus", "Earth", "Mars"], correct: "Mercury" },
                { question: "What is the largest planet?", answers: ["Earth", "Jupiter", "Mars", "Saturn"], correct: "Jupiter" },
                { question: "Which planet is known as the Red Planet?", answers: ["Mars", "Jupiter", "Venus", "Saturn"], correct: "Mars" },
                { question: "What is the smallest planet in the Solar System?", answers: ["Mercury", "Mars", "Venus", "Pluto"], correct: "Mercury" },
                { question: "Which planet has the most moons?", answers: ["Saturn", "Jupiter", "Uranus", "Neptune"], correct: "Saturn" },
                { question: "What is the name of Earth's natural satellite?", answers: ["Moon", "Titan", "Europa", "Ganymede"], correct: "Moon" },
                { question: "Which planet is known for its beautiful rings?", answers: ["Saturn", "Jupiter", "Uranus", "Neptune"], correct: "Saturn" },
                { question: "What is the hottest planet in the Solar System?", answers: ["Venus", "Mercury", "Earth", "Mars"], correct: "Venus" },
                { question: "Which planet is closest in size to Earth?", answers: ["Venus", "Mars", "Mercury", "Jupiter"], correct: "Venus" },
                { question: "What is the name of the galaxy we live in?", answers: ["Andromeda", "Milky Way", "Triangulum", "Sombrero"], correct: "Milky Way" },
                { question: "Which planet is known as the 'Morning Star' or 'Evening Star'?", answers: ["Mars", "Venus", "Mercury", "Jupiter"], correct: "Venus" },
                { question: "What is the name of the first human to travel into space?", answers: ["Yuri Gagarin", "Neil Armstrong", "Alan Shepard", "John Glenn"], correct: "Yuri Gagarin" },
                { question: "What is the name of the first artificial satellite launched by humanity?", answers: ["Apollo 11", "Sputnik 1", "Vostok 1", "Explorer 1"], correct: "Sputnik 1" },
                { question: "Which planet has the shortest day?", answers: ["Venus", "Mars", "Earth", "Jupiter"], correct: "Jupiter" },
                { question: "What is the name of the largest moon of Jupiter?", answers: ["Ganymede", "Titan", "Io", "Europa"], correct: "Ganymede" },
                { question: "Which planet is known for its Great Red Spot?", answers: ["Jupiter", "Saturn", "Neptune", "Mars"], correct: "Jupiter" },
                { question: "What is the name of the first planet discovered with a telescope?", answers: ["Uranus", "Neptune", "Saturn", "Jupiter"], correct: "Uranus" },
                { question: "Which planet is the farthest from the Sun?", answers: ["Neptune", "Uranus", "Saturn", "Pluto"], correct: "Neptune" },
                { question: "What is the name of the first spacecraft to land on the Moon?", answers: ["Apollo 11", "Luna 2", "Voyager 1", "Mariner 4"], correct: "Luna 2" },
                { question: "Which planet is known for having the most extreme seasons?", answers: ["Uranus", "Saturn", "Mars", "Earth"], correct: "Uranus" },
                { question: "What is the name of the star at the center of our Solar System?", answers: ["Sirius", "Alpha Centauri", "Sun", "Betelgeuse"], correct: "Sun" },
                { question: "Which planet is known for its blue color due to methane in its atmosphere?", answers: ["Neptune", "Uranus", "Saturn", "Jupiter"], correct: "Neptune" },
                { question: "What is the name of the first dog to travel to space?", answers: ["Laika", "Belka", "Strelka", "Rex"], correct: "Laika" },
                { question: "Which planet is known for its tilted axis, causing it to rotate on its side?", answers: ["Uranus", "Saturn", "Neptune", "Jupiter"], correct: "Uranus" },
                { question: "What is the name of the largest volcano in the Solar System, located on Mars?", answers: ["Olympus Mons", "Mauna Kea", "Mount Everest", "Elysium Mons"], correct: "Olympus Mons" }
            ],
            medium: [
                { question: "How many moons does Mars have?", answers: ["1", "2", "3", "4"], correct: "2" },
                { question: "What is the closest galaxy to the Milky Way?", answers: ["Andromeda", "Triangulum", "Sombrero", "Whirlpool"], correct: "Andromeda" },
                { question: "Which planet is known as the Red Planet?", answers: ["Mars", "Jupiter", "Venus", "Saturn"], correct: "Mars" },
                { question: "What is the largest planet in the Solar System?", answers: ["Earth", "Jupiter", "Saturn", "Neptune"], correct: "Jupiter" },
                { question: "What is the smallest planet in the Solar System?", answers: ["Mercury", "Mars", "Venus", "Pluto"], correct: "Mercury" },
                { question: "Which planet has the longest day?", answers: ["Venus", "Mars", "Earth", "Jupiter"], correct: "Venus" },
                { question: "What is the hottest planet in the Solar System?", answers: ["Venus", "Mercury", "Earth", "Mars"], correct: "Venus" },
                { question: "What is the main component of the Sun?", answers: ["Hydrogen", "Helium", "Oxygen", "Carbon"], correct: "Hydrogen" },
                { question: "Which planet is known for its prominent ring system?", answers: ["Saturn", "Jupiter", "Uranus", "Neptune"], correct: "Saturn" },
                { question: "Which moon is known as the largest in the Solar System?", answers: ["Ganymede", "Titan", "Io", "Europa"], correct: "Ganymede" },
                { question: "Which planet is famous for its Great Red Spot?", answers: ["Jupiter", "Saturn", "Neptune", "Mars"], correct: "Jupiter" },
                { question: "Which planet has the shortest orbit around the Sun?", answers: ["Mercury", "Venus", "Earth", "Mars"], correct: "Mercury" },
                { question: "How many planets are in the Solar System?", answers: ["7", "8", "9", "10"], correct: "8" },
                { question: "What is the name of the first artificial satellite launched by humanity?", answers: ["Apollo 11", "Sputnik 1", "Vostok 1", "Explorer 1"], correct: "Sputnik 1" },
                { question: "What is the largest moon of Saturn?", answers: ["Titan", "Enceladus", "Mimas", "Tethys"], correct: "Titan" },
                { question: "What is the name of the first human to travel into space?", answers: ["Yuri Gagarin", "Neil Armstrong", "Alan Shepard", "John Glenn"], correct: "Yuri Gagarin" },
                { question: "Which space telescope was launched in 1990 and has provided stunning images of distant galaxies?", answers: ["Hubble Space Telescope", "James Webb Space Telescope", "Chandra X-ray Observatory", "Spitzer Space Telescope"], correct: "Hubble Space Telescope" },
                { question: "What is the name of the galaxy that contains our Solar System?", answers: ["Andromeda", "Milky Way", "Triangulum", "Sombrero"], correct: "Milky Way" },
                { question: "Which planet is known for having the most extensive ring system in the Solar System?", answers: ["Jupiter", "Saturn", "Uranus", "Neptune"], correct: "Saturn" },
                { question: "What is the name of the first artificial satellite launched by humanity?", answers: ["Apollo 11", "Sputnik 1", "Vostok 1", "Explorer 1"], correct: "Sputnik 1" },
                { question: "Which star is the closest to Earth?", answers: ["Proxima Centauri", "Alpha Centauri", "Sirius", "Betelgeuse"], correct: "Proxima Centauri" },
                { question: "What is the name of the spacecraft that carried humans to the Moon for the first time?", answers: ["Apollo 11", "Voyager 1", "Gemini 4", "Mercury-Redstone 3"], correct: "Apollo 11" },
                { question: "What is the primary fuel used in most modern rockets?", answers: ["Hydrogen", "Kerosene", "Methane", "Nitrogen"], correct: "Hydrogen" },
                { question: "Which planet is known as the 'Morning Star' or 'Evening Star'?", answers: ["Mars", "Venus", "Mercury", "Jupiter"], correct: "Venus" },
                { question: "What is the name of the largest moon of Jupiter?", answers: ["Ganymede", "Titan", "Io", "Europa"], correct: "Ganymede" }
            ],
            
            hard: [
    { question: "What is the largest galaxy in our Local Group?", answers: ["Milky Way", "Andromeda", "Triangulum", "Sombrero"], correct: "Andromeda" },
    { question: "What is the heaviest naturally occurring element?", answers: ["Uranium", "Thorium", "Plutonium", "Neptunium"], correct: "Uranium" },
    { question: "Which planet has the fastest winds in the Solar System?", answers: ["Jupiter", "Saturn", "Neptune", "Uranus"], correct: "Neptune" },
    { question: "What is the name of the supermassive black hole at the center of the Milky Way?", answers: ["Sagittarius A*", "Cygnus X-1", "M87", "Centaurus A"], correct: "Sagittarius A*" },
    { question: "Which moon of Jupiter is the most volcanically active body in the Solar System?", answers: ["Europa", "Ganymede", "Io", "Callisto"], correct: "Io" },
    { question: "What is the name of the first exoplanet discovered orbiting a Sun-like star?", answers: ["51 Pegasi b", "HD 209458 b", "Kepler-186f", "Proxima Centauri b"], correct: "51 Pegasi b" },
    { question: "What is the name of the phenomenon where light is bent by gravity?", answers: ["Gravitational Lensing", "Redshift", "Doppler Effect", "Time Dilation"], correct: "Gravitational Lensing" },
    { question: "Which spacecraft was the first to leave the Solar System?", answers: ["Voyager 1", "Voyager 2", "Pioneer 10", "New Horizons"], correct: "Voyager 1" },
    { question: "What is the name of the largest known structure in the universe?", answers: ["Hercules-Corona Borealis Great Wall", "Sloan Great Wall", "Pisces-Cetus Supercluster", "Laniakea Supercluster"], correct: "Hercules-Corona Borealis Great Wall" },
    { question: "What is the name of the process that powers the Sun?", answers: ["Nuclear Fusion", "Nuclear Fission", "Gravitational Collapse", "Chemical Combustion"], correct: "Nuclear Fusion" },
    { question: "Which planet has the longest day in the Solar System?", answers: ["Venus", "Mercury", "Jupiter", "Saturn"], correct: "Venus" },
    { question: "What is the name of the first black hole ever imaged?", answers: ["M87*", "Sagittarius A*", "Cygnus X-1", "V404 Cygni"], correct: "M87*" },
    { question: "What is the name of the theory that describes the origin of the universe?", answers: ["Big Bang Theory", "Steady State Theory", "String Theory", "Multiverse Theory"], correct: "Big Bang Theory" },
    { question: "Which galaxy is on a collision course with the Milky Way?", answers: ["Andromeda", "Triangulum", "Sombrero", "Whirlpool"], correct: "Andromeda" },
    { question: "What is the name of the boundary where the Solar System ends and interstellar space begins?", answers: ["Heliopause", "Oort Cloud", "Kuiper Belt", "Termination Shock"], correct: "Heliopause" },
    { question: "What is the name of the largest moon in the Solar System?", answers: ["Ganymede", "Titan", "Callisto", "Europa"], correct: "Ganymede" },
    { question: "What is the name of the first spacecraft to land on a comet?", answers: ["Rosetta", "Philae", "Voyager 1", "New Horizons"], correct: "Philae" },
    { question: "What is the name of the phenomenon where a star explodes at the end of its life?", answers: ["Supernova", "Nebula", "Black Hole", "Pulsar"], correct: "Supernova" },
    { question: "What is the name of the closest star system to the Sun?", answers: ["Alpha Centauri", "Proxima Centauri", "Barnard's Star", "Sirius"], correct: "Alpha Centauri" },
    { question: "What is the name of the first human-made object to reach interstellar space?", answers: ["Voyager 1", "Voyager 2", "Pioneer 10", "New Horizons"], correct: "Voyager 1" },
    { question: "What is the name of the largest known black hole?", answers: ["TON 618", "Sagittarius A*", "M87*", "Cygnus X-1"], correct: "TON 618" },
    { question: "What is the name of the phenomenon where a star collapses into an extremely dense object?", answers: ["Neutron Star", "Black Hole", "White Dwarf", "Pulsar"], correct: "Neutron Star" },
    { question: "What is the name of the first planet discovered outside our Solar System?", answers: ["51 Pegasi b", "HD 209458 b", "Kepler-186f", "Proxima Centauri b"], correct: "51 Pegasi b" },
    { question: "What is the name of the largest volcano in the Solar System?", answers: ["Olympus Mons", "Mauna Kea", "Mount Everest", "Elysium Mons"], correct: "Olympus Mons" },
    { question: "What is the name of the first spacecraft to orbit Jupiter?", answers: ["Galileo", "Juno", "Voyager 1", "Cassini"], correct: "Galileo" },
    { question: "What is the name of the phenomenon where a star temporarily increases in brightness?", answers: ["Nova", "Supernova", "Pulsar", "Quasar"], correct: "Nova" },
    { question: "What is the name of the first human to walk on the Moon?", answers: ["Neil Armstrong", "Buzz Aldrin", "Yuri Gagarin", "Alan Shepard"], correct: "Neil Armstrong" },
    { question: "What is the name of the first spacecraft to land on Mars?", answers: ["Viking 1", "Opportunity", "Curiosity", "Perseverance"], correct: "Viking 1" },
    { question: "What is the name of the phenomenon where a star's core collapses into a black hole?", answers: ["Supernova", "Gamma-Ray Burst", "Neutron Star Formation", "Pulsar"], correct: "Gamma-Ray Burst" },
    { question: "What is the name of the first exoplanet discovered in the habitable zone of a star?", answers: ["Kepler-186f", "Proxima Centauri b", "TRAPPIST-1e", "HD 209458 b"], correct: "Kepler-186f" }
]
        };

        let currentQuestionIndex = 0;
        let correctAnswersCount = 0;
        let wrongAnswersCount = 0;
        let timerInterval;
        let timeRemaining;
        let apiQuestionsCorrect = 0;

        // Initialize game based on category
        if (category === "easy") {
            timeRemaining = Infinity; // No timer for easy level
        } else if (category === "medium") {
            timeRemaining = 5 * 60; // 5 minutes for medium level
        } else if (category === "hard") {
            timeRemaining = 7 * 60; // 7 minutes for hard level
        }

        // Display the selected category and load the first question
        document.getElementById('category-name').innerText = category.charAt(0).toUpperCase() + category.slice(1);
        loadQuestion(category);

        // Timer countdown for medium and hard levels
        if (category !== "easy") {
            timerInterval = setInterval(updateTimer, 1000);
        }

        function updateTimer() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            document.getElementById('timer').innerText = `Time remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            timeRemaining--;

            if (timeRemaining < 0) {
                clearInterval(timerInterval);
                endGame();
            }
        }

        async function loadQuestion(category) {
            let question;
            if ((category === "medium" && currentQuestionIndex === 9) || (category === "hard" && (currentQuestionIndex === 9 || currentQuestionIndex === 24))) {
                // Fetch API question for medium (10th) or hard (10th and 25th)
                question = await fetchAPIQuestion();
            } else {
                question = questions[category][currentQuestionIndex];
            }

            document.getElementById('question-box').innerHTML = `
                <p><strong>Question ${currentQuestionIndex + 1}:</strong></p>
                ${question.image ? `<img src="${question.image}" alt="Math Question" style="width: 100%; max-width: 300px; margin-bottom: 20px;">` : ''}
                <p>${question.question}</p>
            `;

            const answersContainer = document.getElementById('answers');
            answersContainer.innerHTML = ""; // Clear previous answers

            question.answers.forEach(answer => {
                const button = document.createElement("button");
                button.classList.add("answer-button");
                button.innerText = answer;
                button.onclick = () => checkAnswer(answer, question.correct, question.isAPI);
                answersContainer.appendChild(button);
            });
        }

        async function fetchAPIQuestion() {
            const response = await fetch("https://marcconrad.com/uob/banana/api.php");
            const data = await response.json();
            const correctAnswer = data.solution;
            const incorrectAnswers = generateIncorrectAnswers(correctAnswer);

            return {
                question: "Solve the math problem:",
                answers: shuffleArray([correctAnswer, ...incorrectAnswers]),
                correct: correctAnswer.toString(),
                image: data.question,
                isAPI: true
            };
        }

        function generateIncorrectAnswers(correctAnswer) {
            const incorrectAnswers = [];
            while (incorrectAnswers.length < 3) {
                const randomAnswer = Math.floor(Math.random() * 20) + 1; // Random number between 1 and 20
                if (randomAnswer !== correctAnswer && !incorrectAnswers.includes(randomAnswer)) {
                    incorrectAnswers.push(randomAnswer.toString());
                }
            }
            return incorrectAnswers;
        }

        function shuffleArray(array) {
            return array.sort(() => Math.random() - 0.5);
        }

        function checkAnswer(selectedAnswer, correctAnswer, isAPI) {
            if (selectedAnswer === correctAnswer) {
                correctAnswersCount++;
                if (isAPI) apiQuestionsCorrect++;
            } else {
                wrongAnswersCount++;
            }
            nextQuestion();
        }

        function nextQuestion() {
            currentQuestionIndex++;
            if ((category === "easy" && currentQuestionIndex < 15) ||
                (category === "medium" && currentQuestionIndex < 20) ||
                (category === "hard" && currentQuestionIndex < 30)) {
                loadQuestion(category);
            } else {
                endGame();
            }
        }

     

















        function endGame() {
            // Hide the game box and show the game-over box
            document.querySelector('.glassy-box').style.display = 'none';
            document.getElementById('game-over-box').style.display = 'block';

            // Display the game-over details
            document.getElementById('correct-answers').innerText = correctAnswersCount;
            document.getElementById('wrong-answers').innerText = wrongAnswersCount;
            document.getElementById('total-questions').innerText = category === "easy" ? 15 : category === "medium" ? 20 : 30;
               var badgeImage = "";
             // Send data to PHP backend using fetch
            
            // Display badges based on rules
           
            let badgeDetails = "";
            let batchId = "";

            if (category === "easy" && correctAnswersCount >= 8) {
                badgeImage = "imgs/5.png";
                batchId = "5";
                badgeDetails = "Congratulations! You scored 8 or more in the Easy level.";
               
            } else if (category === "medium" && correctAnswersCount >= 15) {
                if (apiQuestionsCorrect >= 1) {
                    badgeImage = "imgs/m2.png";
                    batchId = "4";
                    badgeDetails = "Congratulations! You scored 15 or more and answered the Bonus question correctly.";
                } else {
                    badgeImage = "imgs/m1.png";
                    batchId = "3";
                    badgeDetails = "Congratulations! You scored 15 or more in the Medium level.";
                }
            } else if (category === "hard") {
                if (correctAnswersCount >= 27 && apiQuestionsCorrect === 2) {
                    badgeImage = "imgs/h3.png";
                    batchId = "2";
                    badgeDetails = "Congratulations! You scored 27 or more and answered both API questions correctly.";
                } else if (correctAnswersCount >= 25 && apiQuestionsCorrect >= 1) {
                    badgeImage = "imgs/h2.jpg";
                    batchId = "1";
                    badgeDetails = "Congratulations! You scored 25 or more and answered at least one API question correctly.";
                } else if (correctAnswersCount >= 20) {
                    badgeImage = "imgs/h1.png";
                    badgeDetails = "Congratulations! You scored 20 or more in the Hard level.";
                }
            }

            if (badgeImage) {
                document.getElementById('badge').src = badgeImage;
                document.getElementById('badge').style.display = "block";
                document.getElementById('badge-details').innerText = badgeDetails;
                document.getElementById('badge-details').style.display = "block";

                // Set up social media sharing links
                const shareText = `I scored ${correctAnswersCount}/${category === "easy" ? 15 : category === "medium" ? 20 : 30} in AstroXteller! Check out my badge: ${badgeImage}`;
                document.getElementById('share-facebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(badgeImage)}&quote=${encodeURIComponent(shareText)}`;
                document.getElementById('share-instagram').href = `https://www.instagram.com/?url=${encodeURIComponent(badgeImage)}&title=${encodeURIComponent(shareText)}`;
                document.getElementById('share-linkedin').href = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(badgeImage)}&title=${encodeURIComponent(shareText)}`;
            }

            const formData = new FormData();
            formData.append('correct-answers', correctAnswersCount);
            formData.append('badge', batchId);
            fetch('scoresave.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);  // Output the response from PHP (success or error)
            })
            .catch(error => {
                console.error('Error:', error);
            }); 
            
        }


            





// share your badge using social media 

        function shareOnFacebook() {
    const badgeImageUrl = "URL_OF_YOUR_BADGE_IMAGE"; // Replace with your actual badge image URL
    const shareMessage = encodeURIComponent("I earned this awesome badge on AstroXteller!");
    const url = `https://www.facebook.com/sharer/sharer.php?u=${badgeImageUrl}&quote=${shareMessage}`;

    window.open(url, '_blank', 'width=600,height=400');
}

function shareOnInstagram() {
    const badgeImageUrl = "URL_OF_YOUR_BADGE_IMAGE"; // Replace with your actual badge image URL
    const instagramMessage = encodeURIComponent("Check out the badge I earned on AstroXteller!");
    
    // Instagram sharing is not fully automated via URL; typically users upload content directly in the Instagram app. 
    // This link will open Instagram's website where they can manually post content.
    const instagramUrl = `https://www.instagram.com/create/style/`;
    window.open(instagramUrl, '_blank', 'width=600,height=400');
}

function shareOnLinkedIn() {
    const badgeImageUrl = "URL_OF_YOUR_BADGE_IMAGE"; // Replace with your actual badge image URL
    const shareMessage = encodeURIComponent("I earned this badge on AstroXteller!");
    const url = `https://www.linkedin.com/shareArticle?mini=true&url=${badgeImageUrl}&title=Check out my badge&summary=${shareMessage}`;

    window.open(url, '_blank', 'width=600,height=400');
}

    </script>
</body>
</html>