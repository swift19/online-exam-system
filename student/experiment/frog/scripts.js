var storedIsRubric = localStorage.getItem('isRubric');
console.log("storedIsRubric", storedIsRubric);
let point = 0
if(storedIsRubric > 0){ // 1 for enable rubric
    point = 0
} else {
    point = 5
}

const scoreDisplay = document.getElementById('scoreDisplay');
const tools = document.querySelectorAll('.tool');
const canvas = document.getElementById('frogCanvas');
const ctx = canvas.getContext('2d');
const toolImages = document.querySelectorAll('.tool');
const cutToPiecesButton = document.getElementById('cutToPieces');

// Frog image
const frogImage = new Image();
frogImage.src = 'overlay_image.png'; // Initial image

let Head = false;
let LeftLeg = false;
let RightLeg = false;
let LeftArm = false;
let RightArm = false;

let isDragging = false;
let draggedSprite = null;
let dissectionStarted = false; // Flag to track if the dissection has started
let cutToPieces = false;
// Sprite objects
const sprites = [
    { x: 10, y: 50, image: 'tool1-cut.png', hidden: false },
    { x: 10, y: 100, image: 'tool2-cut.png', hidden: false },
    { x: 10, y: 150, image: 'tool3-cut.png', hidden: false }
];

// Store initial sprite positions for resetting
const initialSpritePositions = sprites.map(sprite => ({ x: sprite.x, y: sprite.y }));

// Function to draw the canvas
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw frogImage only if it has completed loading
    if (frogImage.complete && frogImage.naturalWidth !== 0) {
        ctx.drawImage(frogImage, 150, 50, 320, 220);
    }
    // Draw sprites
    if(cutToPieces){
        sprites.forEach(sprite => {
            if (!sprite.hidden) {
                const spriteImage = new Image();
                spriteImage.onload = () => {
                    ctx.drawImage(spriteImage, sprite.x, sprite.y, 50, 50);
                };
                spriteImage.src = sprite.image;
            }
        });
    } else {
        sprites.forEach(sprite => {
            const spriteImage = new Image();
            spriteImage.onload = () => {
                ctx.drawImage(spriteImage, sprite.x, sprite.y, 50, 50);
            };
            spriteImage.src = sprite.image;
        });
    }
   
    
     // Draw pointer (circle) at a specific position on the frog image
     if (dissectionStarted) {
        const pointerX = 310; // Adjust this value to the desired X position
        const pointerY = 120; // Adjust this value to the desired Y position
        const pointerRadius = 10;
        
        ctx.beginPath();
        ctx.arc(pointerX, pointerY, pointerRadius, 0, 2 * Math.PI);
        ctx.fillStyle = 'red'; // Adjust color as needed
        ctx.fill();
        ctx.closePath();
    }
    if (cutToPieces) {

        // Head
        const pointerX = 310; // Adjust this value to the desired X position
        const pointerY = 110; // Adjust this value to the desired Y position
        const pointerRadius = 10;
        ctx.beginPath();
        ctx.arc(pointerX, pointerY, pointerRadius, 0, 2 * Math.PI);
        ctx.fillStyle = 'red'; // Adjust color as needed
        ctx.fill();
        ctx.closePath();

        // Left Leg
        const pointerX1 = 400; 
        const pointerY1 = 170; 
        const pointerRadius1 = 10;
        ctx.beginPath();
        ctx.arc(pointerX1, pointerY1, pointerRadius1, 0, 2 * Math.PI);
        ctx.fillStyle = 'red'; // Adjust color as needed
        ctx.fill();
        ctx.closePath();

         // Right Leg
         const pointerX3 = 220; 
         const pointerY3 = 170; 
         const pointerRadius3 = 10;
         ctx.beginPath();
         ctx.arc(pointerX3, pointerY3, pointerRadius3, 0, 2 * Math.PI);
         ctx.fillStyle = 'red'; // Adjust color as needed
         ctx.fill();
         ctx.closePath();

        // Right Arm
        const pointerX2 = 235; 
        const pointerY2 = 75; 
        const pointerRadius2 = 10;
        ctx.beginPath();
        ctx.arc(pointerX2, pointerY2, pointerRadius2, 0, 2 * Math.PI);
        ctx.fillStyle = 'red'; // Adjust color as needed
        ctx.fill();
        ctx.closePath();

         // Left Arm
         const pointerX4 = 385; 
         const pointerY4 = 75; 
         const pointerRadius4 = 10;
         ctx.beginPath();
         ctx.arc(pointerX4, pointerY4, pointerRadius4, 0, 2 * Math.PI);
         ctx.fillStyle = 'red'; // Adjust color as needed
         ctx.fill();
         ctx.closePath();
    }
}

// Check if a point is inside a sprite
function isInsideSprite(x, y, sprite) {
    return (
        x >= sprite.x &&
        x <= sprite.x + 50 &&
        y >= sprite.y &&
        y <= sprite.y + 50
    );
}

// Event handlers
function handleMouseDown(e) {
    const mouseX = e.clientX - canvas.getBoundingClientRect().left;
    const mouseY = e.clientY - canvas.getBoundingClientRect().top;

    sprites.forEach(sprite => {
        if (isInsideSprite(mouseX, mouseY, sprite)) {
            isDragging = true;
            draggedSprite = sprite;
        }
    });
}

function handleMouseMove(e) {
    if (isDragging && draggedSprite) {
        draggedSprite.x = e.clientX - canvas.getBoundingClientRect().left - 25;
        draggedSprite.y = e.clientY - canvas.getBoundingClientRect().top - 25;

        // Check if the dragged sprite is inside the red radius
        const pointerX = 310; // X position of the red radius
        const pointerY = 120; // Y position of the red radius
        const pointerRadius = 10;

        const distance = Math.sqrt(
            Math.pow((draggedSprite.x + 25) - pointerX, 2) +
            Math.pow((draggedSprite.y + 25) - pointerY, 2)
        );

        if (distance <= pointerRadius) {
            // Call your function here when the sprite is inside the red radius
            spriteInsideRedRadius(draggedSprite);
        }

        draw();
    }
}

function spriteInsideRedRadius(draggedSprite) {
    // Your function logic when the sprite is inside the red radius
    console.log('Sprite is inside the red radius!', draggedSprite);
    if (draggedSprite.image === "tool1-cut.png") {
        disableToolsExceptTool('Tool 1');
        return;
    }
    if (draggedSprite.image === "tool2-cut.png") {
        disableToolsExceptTool('Tool 2');
        return;
    }
    if (draggedSprite.image === "tool3-cut.png") {
        disableToolsExceptTool('Tool 3');
        return;
    }
    // Enable all tools
    disableAllTools();
}

// For cut to pieces
function handleMouseMoveCutToPieces(e) {
    if (isDragging && draggedSprite) {
        draggedSprite.x = e.clientX - canvas.getBoundingClientRect().left - 25;
        draggedSprite.y = e.clientY - canvas.getBoundingClientRect().top - 25;

        const pointers = [
            { part: 'Head', x: 310, y: 120, radius: 20 },    // Head
            { part: 'Left Leg', x: 400, y: 170, radius: 20 },  // Left Leg
            { part: 'Right Leg', x: 220, y: 170, radius: 20 }, // Right Leg
            { part: 'Right Arm', x: 235, y: 75, radius: 20 },  // Right Arm
            { part: 'Left Arm', x: 385, y: 75, radius: 20 }    // Left Arm
        ];

        let insideAnyPointer = false;
        let insidePart = null;
        for (const pointer of pointers) {
            const distance = Math.sqrt(
                Math.pow((draggedSprite.x + 25) - pointer.x, 2) +
                Math.pow((draggedSprite.y + 25) - pointer.y, 2)
            );

            if (distance <= pointer.radius) {
                insideAnyPointer = true;
                insidePart = pointer.part;
                break; // Break out of the loop if inside any pointer
            }
        }

        if (insideAnyPointer) {
            // Call your function here when the sprite is inside any pointer
            spriteInsidePointer(draggedSprite, insidePart);
        }

        draw();
    }
}

function spriteInsidePointer(draggedSprite, insidePart) {
    // Your function logic when the sprite is inside a specific pointer
    console.log(`Sprite is inside the ${insidePart} pointer!`, draggedSprite);

    // Handle specific logic for different body parts if needed
    if (insidePart === 'Head') {
        Head = true;
    } else if (insidePart === 'Left Leg') {
        LeftLeg = true;
    } else if (insidePart === 'Right Leg') {
        RightLeg = true;
    } else if (insidePart === 'Right Arm') {
        RightArm = true;
    } else if (insidePart === 'Left Arm') {
        LeftArm = true;
    }
  
}

function disableAllTools() {
    // Enable all tools by removing the 'disabled' class
    tools.forEach(tool => {
        // tool.classList.remove('disabled');
        tool.classList.add('disabled');
    });
}

function disableToolsExceptTool(toolToEnable) {
    // Disable all tools except the one with alt=toolToEnable
    tools.forEach(tool => {
        if (tool.alt !== toolToEnable) {
            tool.classList.add('disabled');
        } else {
            tool.classList.remove('disabled');
        }
    });
}

function handleMouseUp() {
    isDragging = false;
    draggedSprite = null;
}

function handleStartButtonClick() {
    // Change frogImage.src to another image
    frogImage.src = 'frog_step_0.png'; // Change this to the path of your new image
    currentStep = 0;
    tool2Used = false;
    tool0Used = false;
    tool1Used = false;
    cutToPieces = false;
    score = 0;
    scoreDisplay.innerText = `Score: ${score}`; // Update the score display
    startButton.innerText = 'Reset Disecting';
    cutToPiecesButton.style.display = "none"; // hide cutToPieces
    dissectionStarted = true;
    disableAllTools();
    updateFrogImage();
    // Preload the new image
    frogImage.onload = () => {
        // Redraw
        draw();
    };
}

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
                        score -= point;
                    }
                    break;
                case 1:
                    if (index === 0) {
                        tool0Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= point;
                    }
                    break;
                case 2:
                    if (index === 1) {
                        tool1Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= point;
                    }
                    break;
                case 3:
                    if (index === 1) {
                        tool1Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= point;
                    }
                    break;
                case 4:
                    if (index === 0) {
                        tool0Used = true;
                        currentStep++;
                        score += 5;
                    } else {
                        // Incorrect tool, deduct 5 points
                        score -= point;
                    }
                    break;
            }
            updateFrogImage();
            scoreDisplay.innerText = `Score: ${score}`;

            console.log(`Step: ${currentStep}, Tool: ${index}`);
            console.log(`After switch - Step: ${currentStep}, Tool: ${index}`);
            console.log(`tool0Used: ${tool0Used}, tool1Used: ${tool1Used}, tool2Used: ${tool2Used}`);
        } else if (cutToPieces){
            // window.alert("test");
            console.log("currentStepCut" , currentStepCut)
            switch (currentStepCut) {
                case 0:
                    if (RightArm) {
                        currentStepCut++;
                        score += 5;
                    } else {
                        score -= point;
                    }
                    break;
                case 1:
                    if (LeftArm) {
                        currentStepCut++;
                        score += 5;
                    } else {
                        score -= point;
                    }
                    break;
                case 2:
                    if (RightLeg) {
                        currentStepCut++;
                        score += 5;
                    } else {
                        score -= point;
                    }
                    break;
                case 3:
                    if (LeftLeg) {
                        currentStepCut++;
                        score += 5;
                    } else {
                        score -= point;
                    }
                    break;
                case 4:
                    if (Head) {
                        currentStepCut++;
                        score += 5;
                    } else {
                        score -= point;
                    }
                    break;
            }
            updateFrogCutImage();
            scoreDisplay.innerText = `Score: ${score}`;
        } else {
            if (index === 0) { // Tool 1
                window.alert("Description Tool 1");
            } else if (index === 1) {   // Tool 2
                window.alert("Description Tool 2");
            } else if (index === 2) { // Tool 3
                window.alert("Description Tool 3");
            }
        }
    });
});

function updateFrogImage() {
    frogImage.src = `frog_step_${currentStep}.png`;
      // Reset sprite positions
      sprites.forEach(sprite => {
        sprite.x = initialSpritePositions[sprites.indexOf(sprite)].x;
        sprite.y = initialSpritePositions[sprites.indexOf(sprite)].y;
    });
}

function updateFrogCutImage() {
    frogImage.src = `frog_cut_${currentStepCut}.png`;
      // Reset sprite positions
      sprites.forEach(sprite => {
        sprite.x = initialSpritePositions[sprites.indexOf(sprite)].x;
        sprite.y = initialSpritePositions[sprites.indexOf(sprite)].y;
    });
}

// Event listeners
canvas.addEventListener('mousedown', function (e) {
    if (dissectionStarted) {
        handleMouseDown(e);
    }
    if (cutToPieces) {
        handleMouseDown(e);
    }
});

canvas.addEventListener('mousemove', function (e) {
    if (dissectionStarted) {
        handleMouseMove(e);
    }
    if (cutToPieces) {
        handleMouseMoveCutToPieces(e);
    }
});

canvas.addEventListener('mouseup', function () {
    if (dissectionStarted) {
        handleMouseUp();
    }
    if (cutToPieces) {
        handleMouseUp();
    }
});

canvas.addEventListener('touchstart', function (e) {
    if (dissectionStarted) {
        handleMouseDown(e.touches[0]);
    }
    if (cutToPieces) {
        handleMouseDown(e.touches[0]);
    }
});

canvas.addEventListener('touchmove', function (e) {
    if (dissectionStarted) {
        handleMouseMove(e.touches[0]);
    }
    if (cutToPieces) {
        handleMouseMoveCutToPieces(e.touches[0]);
    }
});

canvas.addEventListener('touchend', function () {
    if (dissectionStarted) {
        handleMouseUp();
    }
    if (cutToPieces) {
        handleMouseUp();
    }
});

// Button to start the dissection
const startButton = document.getElementById('startButton');
startButton.addEventListener('click', handleStartButtonClick);

// Initial draw
frogImage.onload = draw;

cutToPiecesButton.addEventListener('click', () => {
    frogImage.src = 'frog_cut_0.png';
    cutToPieces = true;
    dissectionStarted = false;
    currentStepCut = 0;
    score = 0;
    startButton.style.display = "none"; // hide startButton
    // Hide all sprites except 'tool3-cut.png'
    sprites.forEach(sprite => {
        if (sprite.image !== 'tool3-cut.png') {
            sprite.hidden = true;
        }
    });
    disableToolsExceptTool('Tool 3');
    // Redraw the canvas
    draw();
});