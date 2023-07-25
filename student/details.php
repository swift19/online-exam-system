
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
                                $query = mysqli_query($link, "select * from admin where id = '$_GET[admin_id]' ");
                                while($data = mysqli_fetch_array($query)) {
                            ?>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body" style="background-color:#DAF7A6;">
                                        <h3><?php echo $data['name']; ?></h3>
                                    </div>

                                    <?php 
                                        $query2 = mysqli_query($link, "select * from exam where admin_id = '$data[id]' ");
                                        while($data2 = mysqli_fetch_array($query2)) {
                                    ?>

                                    <div style="text-align:left; padding:20px; border-bottom:2px #DAF7A6 solid; background-color:#F9F9F9;">
                                        
                                        <h4>Exam Name : <?php echo $data2['name']; ?></h4>

                                        <a href="video_class.php?exam_id=<?php echo $data2['id']; ?>" target="_blank" style="color:#ff0000;">Video Class</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 

                                        <a href="pdf_file.php?exam_id=<?php echo $data2['id']; ?>" target="_blank" style="color:#ff0000;">PDF File</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;

                                        <?php $unique_code = time()."_".$_SESSION['id']."_".rand(111,999); ?>
                                        
                                        <a href="start_exam.php?exam_id=<?php echo $data2['id']; ?>&unique_code=<?php echo $unique_code; ?>" style="color:#ff0000;">Start Online Exam</a>
                                    
                                    </div>
                                    <?php } ?>

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