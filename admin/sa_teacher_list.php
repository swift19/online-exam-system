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
    
        <?php
            include 'db.php';
            if (isset($_POST['chPassword'])) {
                if ($_POST['password'] != "") {                                        
                    
                    $password = $_POST['password'];
                    $teacherid = $_POST['teacherid'];
                    $ins = "UPDATE admin SET pass ='$password' WHERE id ='$teacherid'";    

                    if (mysqli_query ($link, $ins)) {           
                        echo "<script>";
                        echo "self.location='sa_teacher_list.php?msg=<font color=green>Password is Change!</font>';";
                        echo "</script>";
                    }

                }           
            }               
        ?>

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
                            
                            <h5 class="card-header">Teacher List</h5>
                            <span style="padding-left:20px; padding-top:10px;">
                                <?php 
                                    if (isset($_GET['msg'])) {
                                        echo $_GET['msg'];
                                    }
                                ?>
                                <?php 
                                      if (isset($_GET['id']) && isset($_GET['isdelete'])) { 
                                        include 'db.php';
                                        $dlt = "DELETE FROM admin WHERE id = '$_GET[id]'";
                                        mysqli_query ($link, $dlt);
                                        echo "<font color='red'>Delete Success!</font>";
                                    }
                                    if (isset($_GET['status']) && isset($_GET['id'])) {
                                        if ($_GET['status'] == 1) {
                                            $dlt = "UPDATE admin SET status = 2 WHERE id = '$_GET[id]'";
                                            mysqli_query($link, $dlt);
                                            echo "<font color='green'>Status Change to Inactive!</font>";
                                        } else if ($_GET['status'] == 2) {
                                            $dlt = "UPDATE admin SET status = 1 WHERE id = '$_GET[id]'";
                                            mysqli_query($link, $dlt);
                                            echo "<font color='green'>Status Change to Active!</font>";
                                        }
                                    }
                                ?>
                            </span>
                                
                            <div class="card-body">
                                <div class="table-responsive">  
                                        <div class="row">
                                            <div class="col-md-6 d-flex align-items-center">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-6 d-flex align-items-center justify-content-end" style="padding-right: 25px;">
                                                <input type="text" id="searchBox" placeholder="Search by name or username">
                                                <button id="searchButton" class="btn btn-primary btn-xs ml-2">Search</button>
                                            </div>
                                        </div>     
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>Teacher Name</th>
                                                <th>Mobile No.</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <tr>
                                                <?php 
                                                    include 'db.php';    
                                                    $sl = 0;
                                                    if (isset($_GET['value'])) {
                                                        $query = mysqli_query($link, "select * from admin where (name like '$_GET[value]' or username like '$_GET[value]')");
                                                    } else {
                                                        $query = mysqli_query($link, "select * from admin");
                                                    }
                                                    while($data = mysqli_fetch_array($query)) {                                            
                                                ?>
                                                <td><?php echo ++$sl; ?></td>
                                                <td><?php echo $data['username']; ?></td>
                                                <td><?php echo $data['name']; ?></td>
                                                <td><?php echo $data['mobile']; ?></td>
                                                <td><?php echo $data['email']; ?></td>
                                                <td><?php echo $data['pass']; ?></td>
                                                <td>
                                                    <a href="?status=<?php echo $data['status']; ?>&id=<?php echo $data['id']; ?>" 
                                                        <?php if ($data['status'] == 1 || $data['status'] > 1): ?>
                                                            onclick="return confirm('Confirm Action?');"
                                                        <?php endif; ?>
                                                        style="color: <?php echo $data['status'] == 1 ? 'green' : ($data['status'] > 1 ? 'red' : 'orange'); ?>">
                                                        <?php echo $data['status'] == 1 ? 'Active' : ($data['status'] > 1 ? 'Inactive' : 'Pending'); ?>
                                                    </a>    
                                                </td>
                                                <td>
                                                    <a href="?isdelete=true&?id=<?php echo $data['id']; ?>" onclick="return confirm('Delete Confirm?');">Delete</a> 
                                                    &nbsp;/&nbsp; 
                                                    <a class="assignButton" href="#" data-teacherid="<?php echo $data['id']; ?>" onclick="openModal(this); return false;">Change Password</a>
                                                </td>
                                            </tr> 
                                            <?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>

                            <div id="passwordModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal()">&times;</span>
                                    <form action="#" method="post">
                                        <label for="password">New Password:</label>
                                        <input type="password" id="password" name="password" required>
                                        <input type="hidden" id="teacheridInput" name="teacherid">
                                        <input type="submit" name="chPassword" value="Change Password">
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
    <script>

            document.getElementById("searchButton").addEventListener("click", function() {
                var searchValue = document.getElementById("searchBox").value;
                window.location.href = '?value=' + encodeURIComponent(searchValue);
            });
    </script>
    
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
    
    <script>
        function openModal(element) {
            // Get student ID from data attribute
            var teacherid = element.getAttribute("data-teacherid");
            var modal = document.getElementById("passwordModal");
            modal.style.display = "block";

            document.getElementById("teacheridInput").value = teacherid;
        }

        function closeModal() {
            var modal = document.getElementById("passwordModal");
            modal.style.display = "none";
        }

        </script>

</body>
 
</html>

<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>