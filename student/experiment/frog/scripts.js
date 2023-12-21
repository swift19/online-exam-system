const startButton = document.getElementById('startButton');
const overlayImage = document.getElementById('overlayImage');
const tools = document.querySelectorAll('.tool');
const cutToPiecesButton = document.getElementById('cutToPieces');
const scoreDisplay = document.getElementById('scoreDisplay'); // Add a span in your HTML with id="scoreDisplay" to display the score

let currentStep = 0;
let tool2Used = false;
let tool0Used = false;
let tool1Used = false;
let dissectionStarted = false;
let score = 0;

startButton.addEventListener('click', () => {
    currentStep = 0;
    tool2Used = false;
    tool0Used = false;
    tool1Used = false;
    dissectionStarted = true;
    score = 0;
    scoreDisplay.innerText = `Score: ${score}`; // Update the score display
    startButton.innerText = 'Reset';
    updateFrogImage();
});
tools.forEach((tool, index) => {
    tool.addEventListener('click', () => {
        if (dissectionStarted) {
            switch (currentStep) {
                case 0:
                    if (index === 2) {
                        tool2Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= 5;
                    }
                    break;
                case 1:
                    if (index === 0) {
                        tool0Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= 5;
                    }
                    break;
                case 2:
                    if (index === 1) {
                        tool1Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= 5;
                    }
                    break;
                case 3:
                    if (index === 1) {
                        tool1Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= 5;
                    }
                    break;
                case 4:
                    if (index === 0) {
                        tool0Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= 5;
                    }
                    break;
            }
            updateFrogImage();
            scoreDisplay.innerText = `Score: ${score}`;

            console.log(`Step: ${currentStep}, Tool: ${index}`);
            console.log(`After switch - Step: ${currentStep}, Tool: ${index}`);
            console.log(`tool0Used: ${tool0Used}, tool1Used: ${tool1Used}, tool2Used: ${tool2Used}`);
        }
    });
});

function updateFrogImage() {
    overlayImage.src = `frog_step_${currentStep}.png`;
}

cutToPiecesButton.addEventListener('click', () => {
    overlayImage.src = 'cutToPieces.gif';
    // score += 20; // Increment the score for using cutToPiecesButton
    // scoreDisplay.innerText = `Score: ${score}`; // Update the score display
});