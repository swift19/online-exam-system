
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
            <?php include 'navigation.php';  ?>
        </div>
        
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Select a Subject to take a Quiz</h2>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ecommerce-widget">
                        <div class="row">
                            
                            <?php 
                                include 'db.php';
                                $sl = 0;
                                $query = mysqli_query($link, "select * from admin where status = '1' ");
                                while($data = mysqli_fetch_array($query)) {
                            ?>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body" style="background: var(--fuchsia, #F037A5);">
                                        <h3 style="color:white"><?php echo $data['name']; ?></h3>
                                    </div>
                                    <div style="text-align: center; padding:20px;">
                                        <a href="quiz-list.php?admin_id=<?php echo $data['id']; ?>">Details View</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>


                        </div>                
                    </div>
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