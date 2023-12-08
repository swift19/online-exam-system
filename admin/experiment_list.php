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
                            
                            <h5 class="card-header">Experiment | <a href="experiment_add.php" style="color:red;">Add New</a></h5>
                            <span style="padding-left:20px; padding-top:10px;">
                                <?php 
                                    if (isset($_GET['msg'])) {
                                        echo $_GET['msg'];
                                    }
                                ?>
                                <?php 
                                    include 'db.php';
                                    if (isset($_GET['id']) && isset($_GET['isdelete'])) {                                        
                                        $dlt = "DELETE FROM experiment WHERE id = '$_GET[id]'";
                                        mysqli_query ($link, $dlt);
                                        echo "<font color='red'>Delete Success!</font>";
                                    }

                                    $admin_id = $_SESSION['id'];
                                    $selectQuery = "SELECT id FROM student WHERE status = 1 and designation = $admin_id ";
                                    $result = mysqli_query($link, $selectQuery);

                                    if(isset($_GET['id'])){
                                        $selectQuery2 = "SELECT name FROM experiment WHERE id = '$_GET[id]' ";
                                        $result2 = mysqli_query($link, $selectQuery2);
                                        $data = mysqli_fetch_assoc($result2);
                                        $name = $data['name'];
                                        $currentDateTime = date('Y-m-d H:i:s');
                                    }
                                    
                                    if (isset($_GET['islock']) && isset($_GET['id'])) {
                                        if ($_GET['islock'] == 1) {
                                            $dlt = "UPDATE experiment SET islock = 0 WHERE id = '$_GET[id]'";
                                            mysqli_query($link, $dlt);
                                            echo "<font color='green'>Unlock Success!</font>";
                                          
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $student_id = $row['id'];
                                                $ins = "INSERT INTO notification (student_id, details,isread,created_at) VALUES ('$student_id', '$name is Unlock!' ,'0', '$currentDateTime')";
                                                mysqli_query($link, $ins);
                                            }
                                                
                                        } else {
                                            $dlt = "UPDATE experiment SET islock = 1 WHERE id = '$_GET[id]'";
                                            mysqli_query($link, $dlt);
                                            echo "<font color='green'>Lock Success!</font>";

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $student_id = $row['id'];
                                                $ins = "INSERT INTO notification (student_id, details,isread,created_at) VALUES ('$student_id', '$name is Lock!','0', '$currentDateTime')";
                                                mysqli_query($link, $ins);
                                            }
                                        }
                                    }                                    
                                ?>
                            </span>
                                
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Experiment Name</th>
                                                <th>URL</th>
                                                <th>Add Question</th>
                                                <th>Lock/Unlock</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include 'db.php';
                                                $sl = 0;
                                                $query = mysqli_query($link, "select * from experiment where status = '1' and admin_id = '$_SESSION[id]' ");
                                                while($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$sl; ?></td>
                                                <td><?php echo $data['name']; ?></td>
                                                <td><?php echo $data['url']; ?></td>
                                                <td><a href="question_experiment_add.php?id=<?php echo $data['id']; ?>">Click Me</a></td>
                                                <td>
                                                    <a href="?islock=<?php echo $data['islock']; ?>&id=<?php echo $data['id']; ?>" 
                                                        onclick="return confirm('Confirm Action?');">
                                                        <?php echo $data['islock'] > 0 ? 'Unlock':'Lock'; ?>
                                                    </a>    
                                                </td>
                                                <td><a href="?isdelete=true&id=<?php echo $data['id']; ?>" onclick="return confirm('Delete Confirm?');">Delete</a></td>
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