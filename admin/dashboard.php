
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
                <div class="dashboard-ecommerce">
                    <div class="container-fluid dashboard-content ">
                        
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header">
                                <?php if ($_SESSION['u']==='superadmin') { ?>
                                    <h2 class="pageheader-title">Welcome to Super Admin Dashboard </h2>
                                <?php } else { ?>
                                    <h2 class="pageheader-title">Welcome <?php echo $_SESSION['n']; ?> </h2>
                                    <a style="cursor: pointer;" onclick="openPDF()"><i class="fas fa-book mr-2"></i>KBA |  </a>
                                    <?php 
                                        include 'db.php';
                                        $currentDate = date('Y-m-d');
                                        $query = mysqli_query($link, "SELECT * FROM semester WHERE status = '1' AND '$currentDate' BETWEEN startDate AND endDate");
                                        while($data = mysqli_fetch_array($query)) {
                                            echo "$data[name]";
                                        }
                                    ?>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ecommerce-widget">

                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-muted">Total Student</h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1">
                                                    <?php 
                                                        include 'db.php';
                                                        $sl = 0;
                                                        $query = mysqli_query($link, "select * from student where status = '1' and designation  = '$_SESSION[id]'");
                                                        while($data = mysqli_fetch_array($query)) {
                                                            $sl = $sl+1;
                                                        }
                                                        echo $sl;
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-muted">Total Subject</h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1">
                                                    <?php 
                                                        include 'db.php';
                                                        $sl = 0;
                                                        $query = mysqli_query($link, "select * from subject where status = '1' and admin_id = '$_SESSION[id]' ");
                                                        while($data = mysqli_fetch_array($query)) {
                                                            $sl = $sl+1;
                                                        }
                                                        echo $sl;
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-muted">Total Exam</h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1">
                                                    <?php 
                                                        include 'db.php';
                                                        $sl = 0;
                                                        $query = mysqli_query($link, "select * from exam where status = '1' and admin_id = '$_SESSION[id]'");
                                                        while($data = mysqli_fetch_array($query)) {
                                                            $sl = $sl+1;
                                                        }
                                                        echo $sl;
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-muted">Total Videos</h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1">
                                                    <?php 
                                                        include 'db.php';
                                                        $sl = 0;
                                                        $query = mysqli_query($link, "select * from vdo where status = '1' and admin_id = '$_SESSION[id]' ");
                                                        while($data = mysqli_fetch_array($query)) {
                                                            $sl = $sl+1;
                                                        }
                                                        echo $sl;
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <!-- 2nd row -->
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-muted">Total Unassigned Student</h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1">
                                                    <?php 
                                                        include 'db.php';
                                                        $sl = 0;
                                                        $query = mysqli_query($link, "select * from student where status = '1' and designation = 0 ");
                                                        while($data = mysqli_fetch_array($query)) {
                                                            $sl = $sl+1;
                                                        }
                                                        echo $sl;
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-muted">Total Experiment</h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1">
                                                    <?php 
                                                        include 'db.php';
                                                        $sl = 0;
                                                        $query = mysqli_query($link, "select * from experiment where status = '1' and admin_id = '$_SESSION[id]' ");
                                                        while($data = mysqli_fetch_array($query)) {
                                                            $sl = $sl+1;
                                                        }
                                                        echo $sl;
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-muted">Total PDF File</h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1">
                                                    <?php 
                                                        include 'db.php';
                                                        $sl = 0;
                                                        $query = mysqli_query($link, "select * from pdf where status = '1' and admin_id = '$_SESSION[id]'");
                                                        while($data = mysqli_fetch_array($query)) {
                                                            $sl = $sl+1;
                                                        }
                                                        echo $sl;
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Registered Students</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                        <div class="row">
                                            <div class="col-md-6 d-flex align-items-center">
                                                <a href="" style="color:red; padding-left:20px;" id="assignAllButton">Accept All</a>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-center justify-content-end" style="padding-right: 25px;">
                                                <input type="text" id="searchBox" placeholder="Search by name or section">
                                                <button id="searchButton" class="btn btn-primary btn-xs ml-2">Search</button>
                                            </div>
                                        </div>
                                       
                                            <table class="table">
                                                <thead class="bg-light">
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
                                                        $query = mysqli_query($link, "select * from student where designation = 0 and status = '1' order by id desc limit 10");
                                                        while($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                    <tr>
                                                        <td><input type="checkbox" class="checkBox" style="padding-left: 10px;" value="<?php echo $data['id']; ?>"></td>                                                        
                                                        <td><?php echo $data['studentid']; ?></td>
                                                        <td><?php echo $data['name']; ?></td>
                                                        <td><?php echo $data['dept']; ?></td>
                                                        <td><?php echo $data['phoneno']; ?></td>
                                                        <td><?php echo $data['email']; ?></td>                                                                                             
                                                        <td><?php echo $data['address']; ?></td>
                                                        <td>
                                                            <a class="assignButton" href="#" data-studentid="<?php echo $data['id']; ?>" onclick="assignStudent(this); return false;">Accept</a>                                                            
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
                
            </div>
            
        </div>
        <?php include 'footer_file.php'; ?>

        <script>
            function openPDF() {
                var pdfPath = 'assets/teacher-kba.pdf';
                window.open(pdfPath, '_blank');
            }
            document.getElementById("searchButton").addEventListener("click", function() {
                var searchValue = document.getElementById("searchBox").value;
                var sessionId = 0;
                updateTable(searchValue , sessionId);
            });

            document.getElementById("selectAll").addEventListener("click", function() {
                var checkboxes = document.getElementsByClassName("checkBox");
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = this.checked;
                }
            });

            document.getElementById("assignAllButton").addEventListener("click", function() {
                var selectedCheckboxes = document.querySelectorAll('.checkBox:checked');
                var sessionId = <?php echo json_encode($_SESSION['id']); ?>;
                
                selectedCheckboxes.forEach(function(checkbox) {
                    var studentId = checkbox.value;
                    studentDesignation(studentId, sessionId);
                });
            });

            function assignStudent(linkElement) {
                var studentId = linkElement.getAttribute("data-studentid");  
                var sessionId = <?php echo json_encode($_SESSION['id']); ?>;
                
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
                var data = "searchValue=" + encodeURIComponent(searchValue) + "&sessionId=" + encodeURIComponent(sessionId);
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