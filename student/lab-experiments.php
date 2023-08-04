
<?php 
    session_start(); 
    if ($_SESSION['p'] != "") {
?>
<!doctype html>
<html lang="en">
 
<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <script>
        
        function handleStartButtonClick() {
            // Get the selected values from the two select elements
            var selectedExperimentType = document.getElementById('subject-filter').value;
            var selectedExperiment = document.getElementById('experiment-filter').value;

            // Use the selected values as needed, for example:
            console.log("Selected Experiment Type:", selectedExperimentType);
            console.log("Selected Experiment:", selectedExperiment);

            // Get the canvas element
            var noSelection = document.getElementById('noSelection');
            var densityCanvas = document.getElementById('myDensityCanvas');
            
            // Check the selectedExperiment value and show/hide the canvas accordingly
            if (selectedExperiment === "density") {
                densityCanvas.style.display = "block"; // Show the canvas
                noSelection.style.display = "none"; // Hide the canvas                
            } else {
                densityCanvas.style.display = "none"; // Show the canvas
                noSelection.style.display = "block"; // Hide the canvas
            }
        }
    </script>
    <div class="dashboard-main-wrapper">
        
        <div class="dashboard-header">
            <?php include 'header2.php';  ?>
            <?php include 'navigation.php';  ?>
        </div>

        <div class="experiment">
        <div class="selection">
            <div class="experiment-container">
          
            <div class="col-md-12">
                <div class="row">
                        <div class="form-group select">
                            <label for="subject-filter">Select your type of experiment:</label>
                            <select class="form-control" id="subject-filter">
                                <option value="biology">Biology</option>
                                <option value="physics">Physics</option>
                                <option value="chemistry">Chemistry</option>
                            </select>
                        </div>

                        <div class="form-group select">
                            <select class="form-control" id="experiment-filter">
                                <option value="volcano">Volcano Eruption</option>
                                <option value="disect">Dissect a Frog</option>
                                <option value="density">Density</option>
                            </select>
                        </div>
                        <button class="start-button" onclick="handleStartButtonClick()">Start</button>
                </div>
            </div>
            </div>
        </div>

            <div class="canvas-container"  id="noSelection">            
                not selected
            </div>

            <div class="canvas-container"  id="myDensityCanvas" style="display: none;">            
                <iframe src="./experiment/iframe1.php" ></iframe>
            </div>

           
        </div>
       

    </div>
    <?php include 'footer_file.php'; ?>
</body>
 
</html>
<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>