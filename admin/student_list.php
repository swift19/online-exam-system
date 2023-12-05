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
                            
                            <h5 class="card-header">Student List | <a href="student_add.php" style="color:red;">Add New</a></h5>
                            <span style="padding-left:20px; padding-top:10px;">
                                <?php 
                                    if (isset($_GET['msg'])) {
                                        echo $_GET['msg'];
                                    }
                                ?>
                                <?php 
                                    if (isset($_GET['id'])) {
                                        include 'db.php';
                                        $dlt = "DELETE FROM student WHERE id = '$_GET[id]'";
                                        mysqli_query ($link, $dlt);
                                        echo "<font color='red'>Delete Success!</font>";
                                    }
                                ?>
                            </span>
                                
                            <div class="card-body">
                                <div class="table-responsive">
                                        <div class="row">
                                            <div class="col-md-6 d-flex align-items-center">
                                                <a href="" style="color:red; padding-left:20px;" id="assignAllButton">Unassign All</a>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-center justify-content-end" style="padding-right: 25px;">
                                                <input type="text" id="searchBox" placeholder="Search by name or section">
                                                <button id="searchButton" class="btn btn-primary btn-xs ml-2">Search</button>
                                            </div>
                                        </div>         
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="selectAll"></th>
                                                <th>LRN ID</th>
                                                <th>Full Name</th>
                                                <th>Section</th>
                                                <th>Phone No.</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <?php 
                                                include 'db.php';                                                
                                                $query = mysqli_query($link, "select * from student where status = '1' and designation  = '$_SESSION[id]' ");
                                                while($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                            <td><input type="checkbox" class="checkBox" style="padding-left: 10px;" value="<?php echo $data['id']; ?>"></td>
                                                <td style="cursor:pointer; color:red;" onclick="redirectToStudentRecordPage(<?php echo $data['id']; ?>)"><?php echo $data['studentid']; ?></td>
                                                <td><?php echo $data['name']; ?></td>
                                                <td><?php echo $data['dept']; ?></td>
                                                <td><?php echo $data['phoneno']; ?></td>
                                                <td><?php echo $data['email']; ?></td>
                                                <td><?php echo $data['address']; ?></td>                                                                                                
                                                <td>
                                                    <a href="?id=<?php echo $data['id']; ?>" onclick="return confirm('Delete Confirm?');">Delete</a> 
                                                    &nbsp;/&nbsp; 
                                                    <a class="assignButton" href="#" data-studentid="<?php echo $data['id']; ?>" onclick="unassignStudent(this); return false;">Unassign</a>
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
    
    <script>
            function redirectToStudentRecordPage(studentId) {
                window.location.href = 'student_record.php?id=' + studentId;
            }
            document.getElementById("searchButton").addEventListener("click", function() {
                var searchValue = document.getElementById("searchBox").value;
                var sessionId = <?php echo json_encode($_SESSION['id']); ?>;
                updateTable(searchValue, sessionId);
            });

            document.getElementById("selectAll").addEventListener("click", function() {
                var checkboxes = document.getElementsByClassName("checkBox");
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = this.checked;
                }
            });

            document.getElementById("assignAllButton").addEventListener("click", function() {
                var selectedCheckboxes = document.querySelectorAll('.checkBox:checked');
                var sessionId = 0;
                
                selectedCheckboxes.forEach(function(checkbox) {
                    var studentId = checkbox.value;
                    studentDesignation(studentId, sessionId);
                });
            });

            function unassignStudent(linkElement) {
                var studentId = linkElement.getAttribute("data-studentid");  
                var sessionId = 0;
                
                studentDesignation(studentId , sessionId);
            }

            function studentDesignation(studentId, sessionId) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_designation.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                            location.reload();
                        } else {
                            console.log("Error: " + xhr.status);
                        }
                    }
                };
                
                var data = "studentId=" + encodeURIComponent(studentId) + "&sessionId=" + encodeURIComponent(sessionId);
                xhr.send(data);
            }

            function updateTable(searchValue,sessionId) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "search.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById("tableBody").innerHTML = xhr.responseText;
                    }
                };
                var data = "searchValue=" + encodeURIComponent(searchValue)  + "&sessionId=" + encodeURIComponent(sessionId);
                xhr.send(data);
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