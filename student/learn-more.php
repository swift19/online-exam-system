
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
                                <h2 class="pageheader-title">Discover the Depths of Knowledge</h2>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ecommerce-widget">
                        <div class="row">
                            
                            <?php 
                                include 'db.php';
                                $sl = 0;
                                $query = mysqli_query($link, "SELECT 
                                a.id as stId,
                                a.studentId,
                                a.name,
                                b.id as trId,
                                b.name as teacher
                                FROM student AS a INNER JOIN admin AS b ON a.designation = b.id
                                WHERE a.id = '$_SESSION[id]' ");

                                while($data = mysqli_fetch_array($query)) {
                            ?>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body" style="background: var(--fuchsia, #F037A5);">
                                        <h3 style="color:white"><?php echo $data['teacher']; ?></h3>
                                    </div>

                                    <?php 
                                        $query2 = mysqli_query($link, "select * from exam where admin_id = '$data[trId]' ");
                                        while($data2 = mysqli_fetch_array($query2)) {
                                    ?>

                                    <div style="text-align:left; padding:20px; border-bottom:2px #DAF7A6 solid; background-color:#F9F9F9;">
                                        
                                        <h4><?php echo $data2['name']; ?></h4>

                                        <a href="video_class.php?exam_id=<?php echo $data2['id']; ?>" target="_blank" style="color:#ff0000;">Video Class</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 

                                        <a href="pdf_file.php?exam_id=<?php echo $data2['id']; ?>" target="_blank" style="color:#ff0000;">PDF resource materials</a> &nbsp;&nbsp;&nbsp;

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