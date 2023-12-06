
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
        window.onbeforeunload = function() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "clear_session.php", true);
            xhr.send();
        };
    </script>
    <div class="dashboard-main-wrapper">
        
        <div class="dashboard-header">
            <?php include 'header.php';  ?>            
        </div>
   
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Hello, <?php echo $_SESSION['n']; ?></h2>
                            </div>
                        </div>
                    </div>

                        <form action="quiz-list.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">
                            <img src="./assets/images/play-a-quiz.png" alt="Quiz Icon" class="dash-icon">
                            Play a quiz
                            <span class="arrow-icon fa fa-solid fa-chevron-right"></span>                            
                            </button>
                        </form>

                        <form action="learn-more.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">
                            <img src="./assets/images/want-to-know-more.png" alt="Want to Know More Icon" class="dash-icon">
                            I want to know more
                            <span class="arrow-icon fa fa-solid fa-chevron-right"></span>
                            </button>
                        </form>

                        <form action="result.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">
                            <img src="./assets/images/my-score.png" alt="My Score Icon" class="dash-icon">
                            My Scores
                            <span class="arrow-icon fa fa-solid fa-chevron-right"></span>          
                            </button>
                        </form>
                        <?php 
                        include 'db.php';
                        $query = mysqli_query($link, "SELECT DISTINCT islock FROM `experiment`");
                        if(mysqli_num_rows($query) == 1) {
                         ?>
                        <form action="laboratory-activities.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">
                            <img src="./assets/images/lab-experiment.png" alt="Lab ExpeActivityriment Icon" class="dash-icon">
                            Laboratory Activity
                            <span class="arrow-icon fa fa-solid fa-chevron-right"></span>       
                            </button>
                        </form>
                        <?php } ?>
                        <!-- <form id="labExperimentForm" action="laboratory-activities.php" method="get" class="dashboard-alignment">
                            <button type="button" id="labExperimentButton" class="dashboard-button center">
                                <img src="./assets/images/lab-experiment.png" alt="Lab Experiment Icon" class="dash-icon">
                                Lab Experiments
                                <span class="arrow-icon fa fa-solid fa-chevron-right"></span>
                            </button>
                        </form> -->

                </div>
            </div>
            
        </div>
        
    </div>
    <?php include 'footer_file.php'; ?>
</body>
 <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    const labExperimentButton = document.getElementById('labExperimentButton');
    const labExperimentForm = document.getElementById('labExperimentForm');

    labExperimentButton.addEventListener('click', function() {
        const password = prompt('Please enter the password:');

            if (password === '123') {
                // Password is correct, submit the form
                labExperimentForm.submit();
            } else {
                alert('Incorrect password. Please try again.');
            }
        });
    });
 </script> -->
</html>
<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>