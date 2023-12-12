
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
                                <h2 class="pageheader-title">Let's take a Quiz</h2>
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
                                        $currentDate = date('Y-m-d');
                                        $query_str = mysqli_query($link, "SELECT exam_id FROM started_exam WHERE student_id = '$_SESSION[id]'");
                                        $row_count = mysqli_num_rows($query_str);

                                        if ($row_count > 0) {
                                            $data_str = mysqli_fetch_array($query_str);
                                            $exam_id = $data_str['exam_id'];
                                            $query2 = mysqli_query($link, "SELECT * FROM exam WHERE admin_id = '$data[trId]' 
                                                AND '$currentDate' BETWEEN startDate AND endDate 
                                                AND id != '$exam_id'");
                                        } else {
                                            $query2 = mysqli_query($link, "SELECT * FROM exam WHERE admin_id = '$data[trId]' 
                                                AND '$currentDate' BETWEEN startDate AND endDate");
                                        }

                                        while ($data2 = mysqli_fetch_array($query2)) {
                                            ?>
                                            <div style="text-align:left; padding:20px; border-bottom:2px #DAF7A6 solid; background-color:#F9F9F9;">

                                                <h4><?php echo $data2['name']; ?></h4>

                                                <?php $unique_code = time() . "_" . $_SESSION['id'] . "_" . rand(111, 999); ?>

                                                <a href="start_quiz.php?exam_id=<?php echo $data2['id']; ?>&unique_code=<?php echo $unique_code; ?>" style="color:#ff0000;">Start Online Exam</a>

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