const startButton = document.getElementById('startButton');
const overlayImage = document.getElementById('overlayImage');
const tools = document.querySelectorAll('.tool');
const cutToPiecesButton = document.getElementById('cutToPieces');

let currentStep = 0;
let tool3Used = false;
let tool2Used = 0;
let tool1Used = false;
let dissectionStarted = false;

startButton.addEventListener('click', () => {
    currentStep = 0;
    tool3Used = false;
    tool2Used = 0;
    tool1Used = false;
	dissectionStarted = true; 
	startButton.innerText = 'Reset';
    updateFrogImage();
});

tools.forEach((tool, index) => {
    tool.addEventListener('click', () => {
        if (dissectionStarted) { 
            if (index === 0 && !tool1Used) {
                tool1Used = true;
                currentStep++;
            } else if (index === 1 && tool2Used < 3) {
                tool2Used++;
                currentStep++;
            } else if (index === 2 && !tool3Used) {
                tool3Used = true;
                currentStep++;
            }
            updateFrogImage();
        }
    });
});

function updateFrogImage() {
    overlayImage.src = `frog_step_${currentStep}.png`;
}

cutToPiecesButton.addEventListener('click', () => {
    overlayImage.src = 'cutToPieces.gif';
});