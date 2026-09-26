const quizData = {
    ict: [
        { q: "Which tag is used to embed a JavaScript file in HTML?", options: ["<script>", "<js>", "<javascript>", "<link>"], answer: 0 },
        { q: "Which property is used to change text color in CSS?", options: ["font-color", "text-color", "color", "style"], answer: 2 },
        { q: "What does HTML stand for?", options: ["Hyper Text Markup Language", "High Text Machine Language", "Hyperlink Text Mode Language", "Home Tool Markup Language"], answer: 0 },
        { q: "Which device connects different networks together?", options: ["Switch", "Hub", "Router", "Repeater"], answer: 2 },
        { q: "Which protocol is used for secure web browsing?", options: ["HTTP", "FTP", "HTTPS", "SMTP"], answer: 2 },
        { q: "What is considered the brain of a computer system?", options: ["RAM", "CPU", "Hard Disk", "ALU"], answer: 1 },
        { q: "Which CSS layout feature provides a 2D grid-based system?", options: ["Flexbox", "Grid", "Float", "Position"], answer: 1 },
        { q: "Which of the following is a backend programming language?", options: ["HTML", "CSS", "PHP", "Bootstrap"], answer: 2 },
        { q: "What type of memory is RAM?", options: ["Volatile", "Non-Volatile", "Permanent", "Secondary"], answer: 0 },
        { q: "Which database management system is relational?", options: ["MongoDB", "MySQL", "Redis", "Firebase"], answer: 1 }
    ],
    science: [
        { q: "What is the chemical symbol for Gold?", options: ["Ag", "Au", "Fe", "Hg"], answer: 1 },
        { q: "Which gas do plants absorb during photosynthesis?", options: ["Oxygen", "Nitrogen", "Carbon Dioxide", "Hydrogen"], answer: 2 },
        { q: "What is the hardest natural substance on Earth?", options: ["Gold", "Iron", "Diamond", "Platinum"], answer: 2 },
        { q: "Which planet in our solar system is known as the Red Planet?", options: ["Venus", "Mars", "Jupiter", "Saturn"], answer: 1 },
        { q: "What is the powerhouse of the cell?", options: ["Nucleus", "Ribosome", "Mitochondria", "Cell Membrane"], answer: 2 },
        { q: "What is the speed of light in a vacuum approximately?", options: ["300,000 km/s", "150,000 km/s", "500,000 km/s", "100,000 km/s"], answer: 0 },
        { q: "Which human organ purifies blood?", options: ["Heart", "Lungs", "Kidney", "Liver"], answer: 2 },
        { q: "What is the main gas found in the Earth's atmosphere?", options: ["Oxygen", "Carbon Dioxide", "Nitrogen", "Hydrogen"], answer: 2 },
        { q: "At what temperature does pure water freeze in Celsius?", options: ["-10°C", "0°C", "100°C", "32°C"], answer: 1 },
        { q: "What force keeps planets in orbit around the Sun?", options: ["Friction", "Magnetism", "Gravity", "Electrostatic"], answer: 2 }
    ],
    gk: [
        { q: "Which is the largest ocean on Earth?", options: ["Atlantic Ocean", "Indian Ocean", "Arctic Ocean", "Pacific Ocean"], answer: 3 },
        { q: "Who painted the Mona Lisa?", options: ["Vincent van Gogh", "Leonardo da Vinci", "Pablo Picasso", "Claude Monet"], answer: 1 },
        { q: "What is the capital city of Japan?", options: ["Beijing", "Seoul", "Tokyo", "Bangkok"], answer: 2 },
        { q: "Which country has the largest population in the world?", options: ["India", "China", "USA", "Russia"], answer: 0 },
        { q: "How many continents are there on Earth?", options: ["5", "6", "7", "8"], answer: 2 },
        { q: "In which year did Sri Lanka gain independence?", options: ["1947", "1948", "1952", "1972"], answer: 1 },
        { q: "Which is the longest river in the world?", options: ["Amazon", "Nile", "Yangtze", "Mississippi"], answer: 1 },
        { q: "What is the smallest country in the world?", options: ["Monaco", "Maldives", "Vatican City", "San Marino"], answer: 2 },
        { q: "Which instrument is used to measure earthquake intensity?", options: ["Barometer", "Seismograph", "Thermometer", "Altimeter"], answer: 1 },
        { q: "What is the national flower of Sri Lanka?", options: ["Rose", "Lotus", "Blue Water Lily", "Jasmine"], answer: 2 }
    ]
};

let currentCategory = "ict";
let questions = quizData.ict;
let currentIndex = 0;
let score = 0;
let timeLeft = 30;
let timerInterval = null;
let isAnswered = false;

document.addEventListener('DOMContentLoaded', () => {
    // Read category from URL query or localStorage
    const urlParams = new URLSearchParams(window.location.search);
    const catFromUrl = urlParams.get('cat');
    const savedCategory = catFromUrl || localStorage.getItem('selectedCategory');

    if (savedCategory && quizData[savedCategory]) {
        currentCategory = savedCategory;
    } else {
        currentCategory = 'ict';
    }

    questions = quizData[currentCategory];
    loadQuestion();
});

function loadQuestion() {
    const qElem = document.getElementById('question-text');
    if (!qElem || !questions || !questions[currentIndex]) return;

    isAnswered = false;
    const currentQ = questions[currentIndex];
    qElem.innerText = currentQ.q;

    // Load options safely
    const optA = document.getElementById('optA');
    const optB = document.getElementById('optB');
    const optC = document.getElementById('optC');
    const optD = document.getElementById('optD');

    if (optA) optA.innerText = currentQ.options[0];
    if (optB) optB.innerText = currentQ.options[1];
    if (optC) optC.innerText = currentQ.options[2];
    if (optD) optD.innerText = currentQ.options[3];

    // Progress updates
    const qNum = currentIndex + 1;
    const categoryTitles = { ict: "ICT", science: "SCIENCE", gk: "GENERAL KNOWLEDGE" };

    const progText = document.getElementById('progress-text');
    const catTag = document.getElementById('category-tag');
    const progBar = document.getElementById('progress-bar');

    if (progText) progText.innerText = `Question ${qNum < 10 ? '0' + qNum : qNum} of 10`;
    if (catTag) catTag.innerText = `CATEGORY: ${categoryTitles[currentCategory]} • QUESTION ${qNum} OF 10`;
    if (progBar) progBar.style.width = `${(qNum / 10) * 100}%`;

    // Reset option styling
    document.querySelectorAll('.option-card').forEach(opt => {
        opt.classList.remove('selected', 'correct', 'wrong');
    });

    startTimer();
}

function selectOption(element) {
    if (isAnswered) return;
    isAnswered = true;
    clearInterval(timerInterval);

    const card = element.closest('.option-card');
    const allOptions = Array.from(document.querySelectorAll('.option-card'));
    const selectedIndex = allOptions.indexOf(card);
    const correctIndex = questions[currentIndex].answer;

    if (selectedIndex === correctIndex) {
        card.classList.add('correct');
        score += 10;
    } else {
        card.classList.add('wrong');
        if (allOptions[correctIndex]) {
            allOptions[correctIndex].classList.add('correct');
        }
    }
}

function nextQuestion() {
    if (currentIndex < questions.length - 1) {
        currentIndex++;
        loadQuestion();
    } else {
        clearInterval(timerInterval);
        showScoreModal();
    }
}

function saveScoreToDB(finalScore) {
    const formData = new FormData();
    formData.append('score', finalScore);
    formData.append('category', currentCategory);

    fetch('save_score.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => console.log('Score saved:', data))
    .catch(err => console.error('Save error:', err));
}

function showScoreModal() {
    const modal = document.getElementById('score-modal');
    const finalScoreElem = document.getElementById('final-score');

    if (modal && finalScoreElem) {
        finalScoreElem.innerText = score;
        modal.classList.remove('d-none');
        saveScoreToDB(score);
    }
}

function restartQuiz() {
    window.location.href = 'dashboard.php';
}

function startTimer() {
    clearInterval(timerInterval);
    timeLeft = 30;
    updateTimerText();

    timerInterval = setInterval(() => {
        timeLeft--;
        updateTimerText();

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            nextQuestion();
        }
    }, 1000);
}

function updateTimerText() {
    const timerElem = document.getElementById('timer-text');
    if (timerElem) {
        timerElem.innerText = `00:${timeLeft < 10 ? '0' + timeLeft : timeLeft}`;
    }
}