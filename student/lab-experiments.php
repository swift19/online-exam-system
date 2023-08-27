
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
            var volcanoCanvas = document.getElementById('myVolcanoCanvas');
            
            // Check the selectedExperiment value and show/hide the canvas accordingly
            if (selectedExperiment === "density") {
                densityCanvas.style.display = "block"; // Show density 
                volcanoCanvas.style.display = "none"; // Hide density 
                noSelection.style.display = "none"; // Hide no selection
            } else if (selectedExperiment === "volcano") {
                densityCanvas.style.display = "none"; // Hide density
                volcanoCanvas.style.display = "block"; // Show density 
                noSelection.style.display = "none"; // Hide no selection         
            } else {
                densityCanvas.style.display = "none"; // Hide density 
                volcanoCanvas.style.display = "none"; // Hide volcano 
                noSelection.style.display = "block"; // Show no selection 
            }

          

        }
    </script>
    <div class="dashboard-main-wrapper">
        
        <div class="dashboard-header">
            <?php include 'header.php';  ?>
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
                        <button class="start-button" onclick="handleStartButtonClick()" id="resizeIframe">Start</button>
                </div>
            </div>
            </div>
        </div>

            <div class="canvas-container"  id="noSelection" >            
                not selected
            </div>

            <div class="canvas-container" id="myDensityCanvas" style="display: none;">            
                <iframe src="./experiment/iframe1.php" ></iframe>
            </div>

            <div class="canvas-container" id="myVolcanoCanvas" style="display: none;">            
                <iframe src="./experiment/volcano/index.html" ></iframe>
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