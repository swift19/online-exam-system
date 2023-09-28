
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

            // Make an AJAX request to fetch the iframe content based on the selected values
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "process_selection.php?experimentType=" + selectedExperimentType + "&experiment=" + selectedExperiment, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var iframeContent = xhr.responseText;
                    console.log("iframe url:" ,iframeContent )
                    var iframe = document.getElementById("experiment-iframe");
                    iframe.src = iframe.src; // Refresh the iframe's content
                    document.getElementById("withIFrame").style.display = "block"; // Show the container
                    document.getElementById("noSelection").style.display = "none"; // Hide the container
                }
            };
            xhr.send();
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
                <div class="row draft">
                        <div class="form-group select">
                            <label for="subject-filter">Select your type of experiment:</label>
                            <select name="subject_id" class="form-control lab" id="subject-filter">
                                <option value="" selected disabled>Select category</option>
                                    <?php 
                                        include 'db.php';
                                        $query = mysqli_query($link, "select * from subject where status = '1'");
                                        while($data = mysqli_fetch_array($query)) {
                                            echo "<option value='$data[id]'>$data[name]</option>";
                                        }
                                    ?>                                            
                            </select>
                        </div>

                        <div class="form-group select">
                            <select name="experiment_id" class="form-control lab" id="experiment-filter">
                                <option value="" selected disabled>Select an experiment</option>
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

            <div class="canvas-container" id="withIFrame" style="display: none;">                
                <iframe id="experiment-iframe" src="./experiment/iframe1.php" ></iframe>
            </div>

        </div>
       

    </div>
    <?php include 'footer_file.php'; ?>

    <script>
        // Listen for the change event on the first dropdown
        document.getElementById("subject-filter").addEventListener("change", function() {
            var selectedSubjectId = this.value; // Get the selected value
            
            // Make an AJAX request to fetch experiments based on selected subject
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_experiments.php?subject_id=" + selectedSubjectId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var experiments = JSON.parse(xhr.responseText);
                    var experimentDropdown = document.getElementById("experiment-filter");
                    experimentDropdown.innerHTML = ""; // Clear existing options
                    
                    // Populate the second dropdown with fetched experiments
                    experiments.forEach(function(experiment) {
                        var option = document.createElement("option");
                        option.value = experiment.id;
                        option.textContent = experiment.name;
                        experimentDropdown.appendChild(option);
                    });
                }
            };
            xhr.send();
        });
    </script>
</body>
 
</html>
<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>