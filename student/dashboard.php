
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
        
        <div class="nav-left-sidebar sidebar-dark">
            <?php include 'left_menu.php'; ?>
        </div>
        
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Welcome to Student Dashboard </h2>
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
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body" style="background-color:#DAF7A6;">
                                        <h3><?php echo $data['name']; ?></h3>
                                        <!-- <?php 
                                            $query2 = mysqli_query($link, "select * from admin where id = '$data[admin_id]' ");
                                            while($data2 = mysqli_fetch_array($query2)) {
                                                echo $data2['name'];
                                            }
                                        ?> -->
                                    </div>
                                    <div style="text-align: center; padding:20px;">
                                        <a href="details.php?admin_id=<?php echo $data['id']; ?>">Details View</a>
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