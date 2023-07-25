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
            <div class="container-fluid  dashboard-content">
                
                <div class="row">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            
                            <h5 class="card-header">Result List </h5>
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
                                                <th>Semester</th>
                                                <th>Subject</th>
                                                <th>Exam Name</th>
                                                <th>Total Mark</th>
                                                <th>Your Mark</th>
                                                <th>Merit Position</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sl = 0;
                                                include 'db.php'; 
                                                $query = mysqli_query($link, "select * from result_summery where student_id = '$_SESSION[id]' and sts = '1' order by id desc ");
                                                while($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$sl; ?></td>
                                                <td><?php echo $data['created_at']; ?></td>
                                                
                                                <td>
                                                    <?php 
                                                        $query2 = mysqli_query($link, "select * from semester where id = '$data[semester_id]'");
                                                        while($data2 = mysqli_fetch_array($query2)) {
                                                            echo $data2['name']; 
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $query2 = mysqli_query($link, "select * from subject where id = '$data[subject_id]'");
                                                            while($data2 = mysqli_fetch_array($query2)) {
                                                            echo $data2['name']; 
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $query2 = mysqli_query($link, "select * from exam where id = '$data[exam_id]'");
                                                        while($data2 = mysqli_fetch_array($query2)) {
                                                            echo $data2['name']; 
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $data['total_mark']; ?></td>
                                                <td><?php echo $data['your_mark']; ?></td>
                                                
                                                <td>

                                                    <?php 
                                                        $mp = 1;
                                                        $query3 = mysqli_query($link, "select * from result_summery where exam_id = '$data[exam_id]' and sts = '1' order by your_mark desc ");
                                                        while($data3 = mysqli_fetch_array($query3)) {
                                                            $position = $mp++;
                                                            if ($data['unique_code']==$data3['unique_code']){
                                                                $my_position = $position;
                                                            }
                                                        }
                                                        echo $my_position;

                                                    ?>

                                                </td>
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