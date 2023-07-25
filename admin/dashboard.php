
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
                                <h2 class="pageheader-title">Welcome to Admin Dashboard </h2>
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
                                                    $query = mysqli_query($link, "select * from student where status = '1'");
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
                        </div>
                        <div class="row">
                            
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Registered Students</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Dept.</th>
                                                        <th>Phone No.</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Address</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        include 'db.php';
                                                        $sl = 0;
                                                        $query = mysqli_query($link, "select * from student where status = '1' order by id desc limit 10");
                                                        while($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$sl; ?></td>
                                                        <td><?php echo $data['studentid']; ?></td>
                                                        <td><?php echo $data['name']; ?></td>
                                                        <td><?php echo $data['dept']; ?></td>
                                                        <td><?php echo $data['phoneno']; ?></td>
                                                        <td><?php echo $data['email']; ?></td>
                                                        <td><?php echo $data['pass']; ?></td>                                                                                                
                                                        <td><?php echo $data['address']; ?></td>                                                                                                
                                                        
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
</body>
 
</html>
<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>