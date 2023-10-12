const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
let particles1 = []; // Particle array for sprite 1
let particles2 = []; // Particle array for sprite 2
let particles3 = []; // Particle array for sprite 3
let particles4 = []; // Particle array for sprite 4
let isDraggingSprite1 = false;
let isDraggingSprite2 = false;
let isDraggingSprite3 = false;
let isDraggingSprite4 = false;
let sprite1X = 10;
let sprite1Y = 50;
let sprite2X = 10;
let sprite2Y = 120;
let sprite3X = 10;
let sprite3Y = 190;
let sprite4X = 10;
let sprite4Y = 260;

// Add code to draw the volcano image on the canvas
const volcanoImage = new Image();
volcanoImage.src = "volcano-image.png";
volcanoImage.onload = function() {
    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);
    animate(); // Start the animation after the image loads
};

// Create new image elements for the sprites
const spriteImage1 = new Image();
spriteImage1.src = "sprite-image.png"; // Replace with your sprite image

const spriteImage2 = new Image();
spriteImage2.src = "sprite-image2.png"; // Replace with your sprite image

const spriteImage3 = new Image();
spriteImage3.src = "sprite-image3.png"; // Replace with your sprite image

const spriteImage4 = new Image();
spriteImage4.src = "sprite-image4.png"; // Replace with your sprite image

// Function to draw the sprites on the canvas
function drawSprites() {
    ctx.drawImage(spriteImage1, sprite1X, sprite1Y, 50, 50); // Adjust the size as needed
    ctx.drawImage(spriteImage2, sprite2X, sprite2Y, 50, 50); // Adjust the size as needed
    ctx.drawImage(spriteImage3, sprite3X, sprite3Y, 50, 50); // Adjust the size as needed
    ctx.drawImage(spriteImage4, sprite4X, sprite4Y, 50, 50); // Adjust the size as needed
}

// Function to check if a sprite is at the center coordinate
function isAtCenter(spriteX, spriteY) {
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const distance = Math.sqrt((spriteX - centerX) ** 2 + (spriteY - centerY) ** 2);
    return distance < 50; // You can adjust the threshold for the center position
}

// Add event listeners to the canvas to detect clicks on the sprites
canvas.addEventListener("mousedown", function(event) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    // Check if sprite 1 is clicked
    if (mouseX >= sprite1X && mouseX <= sprite1X + 50 && mouseY >= sprite1Y && mouseY <= sprite1Y + 50) {
        isDraggingSprite1 = true;
    }

    // Check if sprite 2 is clicked
    if (mouseX >= sprite2X && mouseX <= sprite2X + 50 && mouseY >= sprite2Y && mouseY <= sprite2Y + 50) {
        isDraggingSprite2 = true;
    }

    // Check if sprite 3 is clicked
    if (mouseX >= sprite3X && mouseX <= sprite3X + 50 && mouseY >= sprite3Y && mouseY <= sprite3Y + 50) {
        isDraggingSprite3 = true;
    }

    // Check if sprite 4 is clicked
    if (mouseX >= sprite4X && mouseX <= sprite4X + 50 && mouseY >= sprite4Y && mouseY <= sprite4Y + 50) {
        isDraggingSprite4 = true;
    }
});

canvas.addEventListener("mousemove", function(event) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    // Update the position of sprite 1 as the user moves the cursor
    if (isDraggingSprite1) {
        sprite1X = mouseX - 25; // Adjust the position offset
        sprite1Y = mouseY - 25; // Adjust the position offset
    }

    // Update the position of sprite 2 as the user moves the cursor
    if (isDraggingSprite2) {
        sprite2X = mouseX - 25; // Adjust the position offset
        sprite2Y = mouseY - 25; // Adjust the position offset
    }

    // Update the position of sprite 3 as the user moves the cursor
    if (isDraggingSprite3) {
        sprite3X = mouseX - 25; // Adjust the position offset
        sprite3Y = mouseY - 25; // Adjust the position offset
    }

    // Update the position of sprite 4 as the user moves the cursor
    if (isDraggingSprite4) {
        sprite4X = mouseX - 25; // Adjust the position offset
        sprite4Y = mouseY - 25; // Adjust the position offset
    }
});

canvas.addEventListener("mouseup", function() {
    isDraggingSprite1 = false;
    isDraggingSprite2 = false;
    isDraggingSprite3 = false;
    isDraggingSprite4 = false;
    
    // Check if any sprite is at the center position and enable the button accordingly
    if (
        isAtCenter(sprite1X, sprite1Y) &&
        isAtCenter(sprite2X, sprite2Y) &&
        isAtCenter(sprite3X, sprite3Y) &&
        isAtCenter(sprite4X, sprite4Y)
    ) {
        document.getElementById("addChemicalsBtn").disabled = false;
    } else {
        document.getElementById("addChemicalsBtn").disabled = true;
    }
});

class Particle {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.radius = 2 + Math.random() * 4;
        this.vx = -1 + Math.random() * 2;
        this.vy = -5 - Math.random() * 2; // Increase the negative value for higher initial motion
        this.color = "#FF5733";
        this.gravity = 0.1;
        this.life = 80 + Math.random() * 20;
    }

    update() {
        this.vx *= 0.99;
        this.vy += this.gravity;
        this.x += this.vx;
        this.y += this.vy;
        this.life--;
    }

    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.fill();
    }
}


function drawVolcano() {
    // Adjust the size of the volcano image by specifying the height and width
	const imageWidth = canvas.width;
    const imageHeight = canvas.height / 2;
	 // Adjust the position of the volcano image by specifying the x and y coordinates
     const volcanoX = 0;
     const volcanoY = canvas.height - imageHeight;
    // ctx.drawImage(volcanoImage, volcanoX, volcanoY, canvas.width - volcanoX * 2, canvas.height + 300);
	ctx.drawImage(volcanoImage, volcanoX, volcanoY, imageWidth, imageHeight);
	
	// Add text above sprite 1
    // const text = "Volcanic Eruption";
    const text = "";
    ctx.font = "18px Arial"; // Set the font and size
    ctx.fillStyle = "black"; // Set the text color
    ctx.fillText(text, volcanoX + 15, volcanoY - 250); // Position the text above sprite 1
}

// Function to draw a dot at the center coordinate
function drawCenterDot() {
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    ctx.beginPath();
    ctx.arc(centerX, centerY, 5, 0, Math.PI * 2);
    ctx.fillStyle = "red";
    ctx.fill();
}

function animate() {
    requestAnimationFrame(animate);
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw the volcano image first as the background
    drawVolcano();

    // Draw the sprites on the canvas
    drawSprites();

    // Draw the dot at the center coordinate
    drawCenterDot();

    // Set the compositing mode to draw particles behind existing content
    ctx.globalCompositeOperation = "destination-over";

    // Update and draw particles for sprite 1
    for (let i = particles1.length - 1; i >= 0; i--) {
        particles1[i].update();
        particles1[i].draw();

        if (particles1[i].life <= 0) {
            particles1.splice(i, 1);
        }
    }

    // Update and draw particles for sprite 2
    for (let i = particles2.length - 1; i >= 0; i--) {
        particles2[i].update();
        particles2[i].draw();

        if (particles2[i].life <= 0) {
            particles2.splice(i, 1);
        }
    }

    // Update and draw particles for sprite 3
    for (let i = particles3.length - 1; i >= 0; i--) {
        particles3[i].update();
        particles3[i].draw();

        if (particles3[i].life <= 0) {
            particles3.splice(i, 1);
        }
    }

    // Update and draw particles for sprite 4
    for (let i = particles4.length - 1; i >= 0; i--) {
        particles4[i].update();
        particles4[i].draw();

        if (particles4[i].life <= 0) {
            particles4.splice(i, 1);
        }
    }

    // Reset the compositing mode for future drawing
    ctx.globalCompositeOperation = "source-over";
}

// Add chemicals for each sprite when the "Add Chemicals" button is clicked
document.getElementById("addChemicalsBtn").addEventListener("click", function() {
    addChemicals(sprite1X, sprite1Y, particles1);
    addChemicals(sprite2X, sprite2Y, particles2);
    addChemicals(sprite3X, sprite3Y, particles3);
    addChemicals(sprite4X, sprite4Y, particles4);
    document.getElementById("addChemicalsBtn").disabled = true;
});

function addChemicals(spriteX, spriteY, particlesArray) {
    for (let i = 0; i < 50; i++) {
        particlesArray.push(new Particle(spriteX + 25, spriteY + 50));
    }
}

// Optional: Adjust the size of the canvas and image
// canvas.width = 800;
// canvas.height = 600;

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}

// Add touch event listeners to the canvas to detect touches on the sprites
canvas.addEventListener("touchstart", function(event) {
    event.preventDefault(); // Prevent default behavior to avoid scrolling or zooming on touch devices
    const rect = canvas.getBoundingClientRect();
    const touchX = event.touches[0].clientX - rect.left;
    const touchY = event.touches[0].clientY - rect.top;

    // Check if sprite 1 is touched
    if (touchX >= sprite1X && touchX <= sprite1X + 50 && touchY >= sprite1Y && touchY <= sprite1Y + 50) {
        isDraggingSprite1 = true;
    }

    // Check if sprite 2 is touched
    if (touchX >= sprite2X && touchX <= sprite2X + 50 && touchY >= sprite2Y && touchY <= sprite2Y + 50) {
        isDraggingSprite2 = true;
    }

    // Check if sprite 3 is touched
    if (touchX >= sprite3X && touchX <= sprite3X + 50 && touchY >= sprite3Y && touchY <= sprite3Y + 50) {
        isDraggingSprite3 = true;
    }

    // Check if sprite 4 is touched
    if (touchX >= sprite4X && touchX <= sprite4X + 50 && touchY >= sprite4Y && touchY <= sprite4Y + 50) {
        isDraggingSprite4 = true;
    }
});

canvas.addEventListener("touchmove", function(event) {
    event.preventDefault(); // Prevent default behavior to avoid scrolling or zooming on touch devices
    const rect = canvas.getBoundingClientRect();
    const touchX = event.touches[0].clientX - rect.left;
    const touchY = event.touches[0].clientY - rect.top;

    // Update the position of sprite 1 as the user moves the touch
    if (isDraggingSprite1) {
        sprite1X = touchX - 25; // Adjust the position offset
        sprite1Y = touchY - 25; // Adjust the position offset
    }

    // Update the position of sprite 2 as the user moves the touch
    if (isDraggingSprite2) {
        sprite2X = touchX - 25; // Adjust the position offset
        sprite2Y = touchY - 25; // Adjust the position offset
    }

    // Update the position of sprite 3 as the user moves the touch
    if (isDraggingSprite3) {
        sprite3X = touchX - 25; // Adjust the position offset
        sprite3Y = touchY - 25; // Adjust the position offset
    }

    // Update the position of sprite 4 as the user moves the touch
    if (isDraggingSprite4) {
        sprite4X = touchX - 25; // Adjust the position offset
        sprite4Y = touchY - 25; // Adjust the position offset
    }
});

canvas.addEventListener("touchend", function() {
    isDraggingSprite1 = false;
    isDraggingSprite2 = false;
    isDraggingSprite3 = false;
    isDraggingSprite4 = false;
    
    // Check if any sprite is at the center position and enable the button accordingly
    if (
        isAtCenter(sprite1X, sprite1Y) &&
        isAtCenter(sprite2X, sprite2Y) &&
        isAtCenter(sprite3X, sprite3Y) &&
        isAtCenter(sprite4X, sprite4Y)
    ) {
        document.getElementById("addChemicalsBtn").disabled = false;
    } else {
        document.getElementById("addChemicalsBtn").disabled = true;
    }
});

