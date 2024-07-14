let timer;
let minutes = 25;
let seconds = 0;
let isPaused = false;
let enteredTime = null;
let breakType = 'work'; // 'work', 'shortBreak', 'longBreak'
let shortBreakTime = 5;
let longBreakTime = 15;

function startTimer() {
    timer = setInterval(updateTimer, 1000);
}

function updateTimer() {
    const timerElement = document.getElementById('timer');
    timerElement.textContent = formatTime(minutes, seconds);
    if (minutes === 0 && seconds === 0) {
        clearInterval(timer);
        if (breakType === 'work') {
            alert('Time is up! Take a break.');
            startBreak('shortBreak');
        } else if (breakType === 'shortBreak') {
            alert('Short break is over! Back to work.');
            startWork();
        } else if (breakType === 'longBreak') {
            alert('Long break is over! Back to work.');
            startWork();
        }
    } else if (!isPaused) {
        if (seconds > 0) {
            seconds--;
        } else {
            seconds = 59;
            minutes--;
        }
    }
}

function formatTime(minutes, seconds) {
    return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}

function togglePauseResume() {
    const pauseResumeButton = document.querySelector('.control-buttons button');
    isPaused = !isPaused;
    if (isPaused) {
        clearInterval(timer);
        pauseResumeButton.textContent = 'Resume';
    } else {
        startTimer();
        pauseResumeButton.textContent = 'Pause';
    }
}

function restartTimer() {
    clearInterval(timer);
    minutes = enteredTime || 25;
    seconds = 0;
    isPaused = false;
    breakType = 'work';
    const timerElement = document.getElementById('timer');
    timerElement.textContent = formatTime(minutes, seconds);
    const pauseResumeButton = document.querySelector('.control-buttons button');
    pauseResumeButton.textContent = 'Pause';
    startTimer();
}

function chooseTime() {
    const newTime = prompt('Enter new time in minutes:');
    if (!isNaN(newTime) && newTime > 0) {
        enteredTime = parseInt(newTime);
        minutes = enteredTime;
        seconds = 0;
        isPaused = false;
        breakType = 'work';
        const timerElement = document.getElementById('timer');
        timerElement.textContent = formatTime(minutes, seconds);
        clearInterval(timer);
        const pauseResumeButton = document.querySelector('.control-buttons button');
        pauseResumeButton.textContent = 'Pause';
        startTimer();
    } else {
        alert('Invalid input. Please enter a valid number greater than 0.');
    }
}

function startBreak(type) {
    breakType = type;
    if (type === 'shortBreak') {
        minutes = shortBreakTime;
    } else if (type === 'longBreak') {
        minutes = longBreakTime;
    }
    seconds = 0;
    isPaused = false;
    const timerElement = document.getElementById('timer');
    timerElement.textContent = formatTime(minutes, seconds);
    clearInterval(timer);
    const pauseResumeButton = document.querySelector('.control-buttons button');
    pauseResumeButton.textContent = 'Pause';
    startTimer();
}

function startWork() {
    breakType = 'work';
    minutes = enteredTime || 25;
    seconds = 0;
    isPaused = false;
    const timerElement = document.getElementById('timer');
    timerElement.textContent = formatTime(minutes, seconds);
    clearInterval(timer);
    const pauseResumeButton = document.querySelector('.control-buttons button');
    pauseResumeButton.textContent = 'Pause';
    startTimer();
}

document.getElementById('start-btn').addEventListener('click', startTimer);
document.getElementById('pause-btn').addEventListener('click', togglePauseResume);
document.getElementById('reset-btn').addEventListener('click', restartTimer);
document.getElementById('choose-time-btn').addEventListener('click', chooseTime);
document.getElementById('short-break-btn').addEventListener('click', function() {
    startBreak('shortBreak');
});
document.getElementById('long-break-btn').addEventListener('click', function() {
    startBreak('longBreak');
});