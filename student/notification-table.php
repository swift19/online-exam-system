<?php 
    session_start(); 
    if ($_SESSION['p'] != "") {
        
?>
<!doctype html>
<html lang="en">
 
<head>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <?php include 'head.php'; 
     $id = $_SESSION['id'];
     include 'db.php'; 
     $dlt = "UPDATE notification SET isread = 1 WHERE student_id = $id";
     mysqli_query($link, $dlt);
     ?>
</head>

<body>
    
    <div class="dashboard-main-wrapper">
        
         <div class="dashboard-header">
            <?php include 'header.php';  ?>
            <?php include 'navigation.php';  ?>
        </div>
        
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                
                <div class="row">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            
                            <h5 class="card-header">Notification List </h5>
                            <span style="padding-left:20px; padding-top:10px;">
                                <?php 
                                    if (isset($_GET['msg'])) {
                                        echo $_GET['msg'];
                                    }
                                ?>
                                
                            </span>
                            
                            <div class="card-body">
                           
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include 'db.php'; 
                                                $sl = 0;
                                                $query = mysqli_query($link, "SELECT *  FROM `notification` WHERE student_id = '$_SESSION[id]' order by id desc");
                                                while($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$sl; ?></td>
                                                <td><?php echo $data['created_at']; ?></td>
                                                <td><?php echo $data['details']; ?></td>
                                            </tr> 
                                            <?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
    <?php
    include 'db.php'; 
    $score = mysqli_query($link, "SELECT DISTINCT b.name, b.total_question, a.your_mark FROM `result_summery` as a INNER JOIN exam as b
    ON a.exam_id = b.id WHERE a.student_id = '$_SESSION[id]' AND sts = '1'");
    
    $data = [];
    
    while ($row = mysqli_fetch_assoc($score)) {
        $data[] = [$row['name'], $row['total_question'], $row['your_mark']];
    }

    // Convert data array and distinct names array to JSON
    $dataJson = json_encode($data);
?>
 
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    
</body>
 
</html>

<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>