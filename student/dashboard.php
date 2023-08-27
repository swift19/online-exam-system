
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

                        <form action="play-a-quiz.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">
                            <img src="./assets/images/play-a-quiz.png" alt="Quiz Icon" class="dash-icon">
                            Play a quiz
                            <span class="arrow-icon fa fa-solid fa-chevron-right"></span>                            
                            </button>
                        </form>

                        <form action="#" method="get" class="dashboard-alignment">
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

                        <form action="lab-experiments.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">
                            <img src="./assets/images/lab-experiment.png" alt="Lab Experiment Icon" class="dash-icon">
                            Lab Experiments
                            <span class="arrow-icon fa fa-solid fa-chevron-right"></span>
                            </button>
                        </form>
<!-- 
                        <form action="registration.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">I want to know more</button>
                        </form>
                        <form action="registration.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">My Scores</button>
                        </form>
                        <form action="lab-experiment.php" method="get" class="dashboard-alignment">
                            <button type="submit" class="dashboard-button center">Lab Experiments</button>
                        </form> -->
                    
                </div>
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