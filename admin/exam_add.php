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

        <?php
            include 'db.php';
            if (isset($_POST['save'])) {
                if ($_POST['name'] != "") {                                        
                    
                    $name = $_POST['name'];
                    $semester_id = $_POST['semester_id'];
                    $subject_id = $_POST['subject_id'];
                    $admin_id = $_SESSION['id'];

                    $duration       = $_POST['duration'];
                    $question_mark  = $_POST['question_mark'];
                    $total_mark     = $_POST['total_mark'];
                    $total_question = $_POST['total_question'];

                    $startDate = $_POST['startDate']." ".$_POST['startTime'];
                    $endDate = $_POST['endDate']." ".$_POST['endTime'];

                    $ins = "INSERT INTO exam (semester_id, subject_id, name, status, admin_id, duration, question_mark, total_mark, total_question,startDate,endDate) 
                    VALUES ('$semester_id', '$subject_id', '$name', '1', '$admin_id', '$duration', '$question_mark', '$total_mark', '$total_question', '$startDate', '$endDate');";    

                    if (mysqli_query ($link, $ins)) {           
                        echo "<script>";
                        echo "self.location='exam_list.php?msg=<font color=green>Subject Added Success!</font>';";
                        echo "</script>";
                    }

                }

            }               
        ?>
        
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="card">
                            
                            <h5 class="card-header">Add New Exam </h5>
                                
                            <div class="card-body">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <?php 
                                                include 'db.php';
                                                $currentDate = date('Y-m-d');
                                                $currentTime = date('H:i:s');
                                                $query = mysqli_query($link, "SELECT * FROM semester WHERE status = '1' AND '$currentDate' BETWEEN startDate AND endDate");
                                                while($data = mysqli_fetch_array($query)) {
                                                    echo "<input name='semester_id' class='form-control form-control-lg' type='text' hidden value='$data[id]'>";
                                                }
                                        ?>
                                        <br>
                                        <select name="subject_id" class="form-control" required>
                                            <option value="" selected disabled>Select Subject</option>
                                            <?php 
                                                include 'db.php';
                                                $currentDate = date('Y-m-d');
                                                $query = mysqli_query($link, "select * from subject where status='1' AND '$currentDate' BETWEEN startDate AND endDate");
                                                while($data = mysqli_fetch_array($query)) {
                                                    echo "<option value='$data[id]'>$data[name]</option>";
                                                }
                                            ?>
                                            
                                        </select>
                                        <br>
                                        <input name="name" class="form-control form-control-lg" type="text" placeholder="Exam Name" autocomplete="off" required>

                                        <br>
                                        <input name="duration" class="form-control form-control-lg" type="number" placeholder="Exam Duration in Min" autocomplete="off" required>
                                        <br>
                                        <input name="question_mark" class="form-control form-control-lg" type="number" placeholder="per Question Mark" autocomplete="off" required>
                                        <br>
                                        <input name="total_mark" class="form-control form-control-lg" type="number" placeholder="Total Mark" autocomplete="off" required>
                                        <br>
                                        <input name="total_question" class="form-control form-control-lg" type="number" placeholder="Total Question" autocomplete="off" required>
                                        <br>
                                        <label>Duration</label>
                                        <div class="form-group">
                                            <label for="startDate">Start Date:</label>
                                            <div style="display: flex;">
                                                <input type="date" class="form-control form-control-lg" name="startDate" id="startDate" value="<?php  echo $currentDate ?>" readonly >
                                                <input type="time" class="form-control form-control-lg" name="startTime" id="startTime" value="<?php  echo $currentTime ?>" readonly >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="endDate">End Date:</label>
                                            <div style="display: flex;">
                                                <input type="date" class="form-control form-control-lg" name="endDate" id="endDate" min="<?php  echo $currentDate ?>" required>
                                                <input type="time" class="form-control form-control-lg" name="endTime" id="endTime" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="save" class="btn btn-primary btn-lg btn-block">Add Confirm</button>
                                </form>
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