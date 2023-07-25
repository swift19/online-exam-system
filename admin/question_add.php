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
                if ($_POST['des'] != "") {                                        
                    
                    $exam_id = $_GET['exam_id'];
                    $des     = $_POST['des'];
                    $op1     = $_POST['op1'];
                    $op2     = $_POST['op2'];
                    $op3     = $_POST['op3'];
                    $op4     = $_POST['op4'];
                    $ans     = $_POST['ans'];
                    
                    $ins = "INSERT INTO question (exam_id, des, op1, op2, op3, op4, ans, status) 
                            VALUES ('$exam_id', '$des', '$op1', '$op2', '$op3', '$op4', '$ans', '1');";    

                    if (mysqli_query ($link, $ins)) {  
                        $msg = "<font color='green'>Added</font>";       
                    }

                }           
            }               
        ?>
        
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        
                            <?php if (isset($msg)) { echo $msg; } ?>
                            <h5>Upload Question </h5>

                            <h5>
                                Exam Name :  
                                <?php 
                                    include 'db.php';
                                    $query = mysqli_query($link, "select * from exam where id = '$_GET[exam_id]'");
                                    while($data = mysqli_fetch_array($query)) {
                                        echo $data['name'];
                                    }
                                ?>
                            </h5>
                                
                            
                            <form action="#" method="post">                                   
                                <div class="row">    
                                    
                                    <div class="col-md-12">                                        
                                        Question : <input type="text" name="des" class="form-control" required>
                                    </div>                             
                                    <div class="col-md-12">&nbsp;</div>
                                    <div class="col-md-6">
                                        Option a : <input type="text" name="op1" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        Option b : <input type="text" name="op2" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>
                                    <div class="col-md-6">
                                        Option c : <input type="text" name="op3" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        Option d : <input type="text" name="op4" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>                                    
                                    <div class="col-md-4">
                                        Ans : 
                                        <select class="form-control" name="ans">
                                            <option value="" selected disabled>Select Ans</option>
                                            <option value="a">a</option>
                                            <option value="b">b</option>
                                            <option value="c">c</option>
                                            <option value="d">d</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>
                                    <button type="submit" name="save" class="btn btn-primary btn-lg btn-block">Upload Confirm</button>
                                </div>
                            </form>
                            
                        
                    </div>                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <br><br>
                    </div>

                    <div class="col-md-12">
                        <h5>View Questions</h5>
                    </div>
                    <div>
                        <?php
                        $sl=0; 
                        $query = mysqli_query($link, "select * from question where exam_id = '$_GET[exam_id]'");
                        while($data = mysqli_fetch_array($query)) {
                            echo ++$sl.". ";
                            echo $data['des'];
                            echo "<br>";
                            echo "a. ".$data['op1'];
                            echo "<br>";
                            echo "b. ".$data['op2'];
                            echo "<br>";
                            echo "c. ".$data['op3'];
                            echo "<br>";
                            echo "d. ".$data['op4'];
                            echo "<br>";
                            echo "Ans : ".$data['ans'];
                            echo "<br>";
                            echo "<hr>";
                        }
                        ?>
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