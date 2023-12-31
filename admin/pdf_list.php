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
                            
                            <h5 class="card-header">PDF File List | <a href="pdf_add.php" style="color:red;">Add New</a></h5>
                            <span style="padding-left:20px; padding-top:10px;">
                                <?php 
                                    if (isset($_GET['msg'])) {
                                        echo $_GET['msg'];
                                    }
                                ?>
                                <?php 
                                    if (isset($_GET['id'])) {
                                        include 'db.php';
                                        $dlt = "DELETE FROM pdf WHERE id = '$_GET[id]'";
                                        mysqli_query ($link, $dlt);
                                        echo "<font color='red'>Delete Success!</font>";
                                    }
                                ?>
                            </span>
                                
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Semester</th>
                                                <th>Subject</th>
                                                <th>Title</th>
                                                <th>Viewers</th>
                                                <th>File View</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include 'db.php';
                                                $sl = 0;
                                                $query = mysqli_query($link, "select * from pdf where status = '1' and admin_id = '$_SESSION[id]' ");
                                                while($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$sl; ?></td>
                                                
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
                                                <td><?php echo $data['title']; ?></td>
                                                <td>
                                                    <?php 
                                                        $query4 = mysqli_query($link, "select * from student where designation = '$_SESSION[id]' ");
                                                        $query3 = mysqli_query($link, "select * from pdf_status where pdf_id = '$data[id]'");
                                                        echo (mysqli_num_rows($query3));
                                                        echo " / ";
                                                        echo (mysqli_num_rows($query4));
                                                    ?>
                                                </td>
                                                <td><a href="assets/<?php echo $data['pdf_file']; ?>" target="_blank">View File</td>
                                                
                                                <td><a href="?id=<?php echo $data['id']; ?>" onclick="return confirm('Delete Confirm?');">Delete</a></td>
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