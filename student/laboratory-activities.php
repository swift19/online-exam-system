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
        document.addEventListener("DOMContentLoaded", function () {
            var iframe = document.getElementById("experiment-iframe");
            var iframeContent = '<?php echo isset($_SESSION["url"]) ? $_SESSION["url"] : "" ?>';

            if (iframeContent !== "") {
                iframe.src = iframe.src; // Refresh the iframe's content
                document.getElementById("withIFrame").style.display = "block";
                document.getElementById("examSelected").style.display = "block";
                document.getElementById("noSelection").style.display = "none";
                var modal = document.getElementById("experimentModal");
                modal.style.display = "block";
            } else {
                document.getElementById("noSelection").style.display = "block";
            }
        });

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
                    // Reload the current page
                    window.location.reload();
                    console.log("iframe url:", iframeContent);
                    var iframe = document.getElementById("experiment-iframe");
                    if(iframe){ 
                        iframe.src = iframe.src; // Refresh the iframe's content
                    }
                    document.getElementById("withIFrame").style.display = "block"; // Show the container
                    document.getElementById("noSelection").style.display = "none"; // Hide the container

                    if(selectedExperiment){
                        // Set the selected experiment value in the hidden input field
                        document.getElementById("experimentInput").value = selectedExperiment;
                        // Submit the form
                        document.getElementById("experimentForm").submit();
                    }
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
                <form id="experimentForm" action="" method="GET" style="margin-bottom:unset">
                    <input type="hidden" id="experimentInput" name="experimentId">
                </form>
          
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
        
        <?php 
        include 'db.php';
        if (isset($_SESSION["exId"]) && $_SESSION['exId']) {
            $experimentId = $_SESSION['exId'];
            $query2 = mysqli_query($link, "select * from experiment where id = '$experimentId' ");
            while($data2 = mysqli_fetch_array($query2)) {
        ?>

        <div id="examSelected" style="text-align:left; padding:20px; border-bottom:2px #DAF7A6 solid; background-color:#F9F9F9;display: none;">
            <h4>Exam Name : <?php echo $data2['name']; ?><a data-experiment=""  onclick="openModal(this); return false;" style="cursor:pointer"> &#128712</a></h4>
            <?php $unique_code = time()."_".$_SESSION['id']."_".rand(111,999); ?>
            <a href="start_quiz_ex.php?experiment_id=<?php echo $data2['id']; ?>&unique_code=<?php echo $unique_code; ?>" style="color:#ff0000;">Start Online Exam</a>
        </div>
        
        <div class="canvas-container centered"  id="noSelection">            
            <!-- <img src="assets/images/no-selected.svg" alt="no selected" class="noSelected-img"> -->
            <span class="noSelected-label">You have no selected experiment yet</span>
        </div>

        <div class="canvas-container" id="withIFrame" style="display: none;">                
            <iframe id="experiment-iframe" src="./experiment/iframe1.php"></iframe>
        </div>
        </div>
    </div>
    <?php include 'footer_file.php'; ?>

                            <div id="experimentModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal()">&times;</span>
                                    <form action="#" method="post" class="modal-form">
                                        <pre><?php echo $data2['description']; ?></pre>
                                    </form>
                                </div>
                            </div>
    <?php }} ?>
    <script>
        function openModal(element) {
            // Get student ID from data attribute
            var modal = document.getElementById("experimentModal");
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById("experimentModal");
            modal.style.display = "none";
        }

        // Listen for the change event on the first dropdown
        document.getElementById("subject-filter").addEventListener("change", function() {
        var selectedSubjectId = this.value;
        
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