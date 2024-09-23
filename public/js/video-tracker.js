let correctCount = 0; 
let answeredCount = 0; 
const totalQuestions = document.querySelectorAll('.quiz').length;
let timerStarted = false; // Flag to check if the timer has started
let quizEnabled = false; // Flag to check if quiz is enabled

// Function to start the timer
function startTimer() {
    if (timerStarted) return;
    timerStarted = true;

    setTimeout(() => {
        quizEnabled = true;
        enableQuizSubmission();
    }, 120000); // 120000 milliseconds = 120 seconds
}

// Enable quiz submission
function enableQuizSubmission() {
    const quizElements = document.querySelectorAll('.ans');
    quizElements.forEach(element => {
        element.style.pointerEvents = 'auto'; // Enable click events
        element.style.opacity = '1'; // Reset opacity
    });
    document.getElementById('enable-quiz').style.display = 'none'; // Hide button
}

// Disable quiz submission by default
function disableQuizSubmission() {
    const quizElements = document.querySelectorAll('.ans');
    quizElements.forEach(element => {
        element.style.pointerEvents = 'none'; // Disable click events
        element.style.opacity = '0.5'; // Reduce opacity
    });
}

// Run this on page load to prevent users from submitting answers prematurely
disableQuizSubmission();
startTimer(); // Start the timer when the page loads

function submitAnswer(element, answer, question) {
    if (!quizEnabled) {
        alert("Bạn cần đợi ít nhất 2 phút để có thể làm quiz.");
        return;
    }

    const parentUl = element.closest('ul');
    const allAnswers = parentUl.querySelectorAll('.ans');
    allAnswers.forEach(ans => {
        ans.style.pointerEvents = 'none';  // Disable clicks on all answers
    });

    const correctAnswer = element.closest('.card').dataset.correctAnswer;
    if (answer === correctAnswer) {
        correctCount++;
        element.style.border = '5px solid green';
    } else {
        element.style.border = '5px solid red';
    }

    answeredCount++;
    updateQuestionCounter(answeredCount, totalQuestions);

    setTimeout(() => {
        if (answeredCount === totalQuestions) {
            showResult();
            showCompletionMessage(); // Show completion message
        } else {
            const nextButton = document.querySelector('.carousel-control-next');
            nextButton.click();
        }
    }, 500);
}

function updateQuestionCounter(answered, total) {
    const counterElement = document.getElementById('question-counter');
    counterElement.textContent = `${answered}/${total}`;
}

function showResult() {
    document.getElementById('correct-answers').innerText = correctCount;
    document.getElementById('result').style.display = 'block';
}

function showCompletionMessage() {
    const completionMessage = document.getElementById('completion-message');
    completionMessage.innerHTML = `<h4>Chúc mừng! Bạn đã hoàn thành tất cả các câu hỏi. Tổng số câu đúng: ${correctCount} / ${totalQuestions}</h4>`;
    completionMessage.style.display = 'block';
}
