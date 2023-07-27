<?php 
    session_start();     
    include 'db.php';   
    if ($_SESSION['p'] != "") {

        if (isset($_PUT['upload'])) {
            if (!isset($_FILES['image']['tmp_name'])) {
                $msg = "Please select an image.";
            } else {
                $file = $_FILES['image']['tmp_name'];
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $image_name = addslashes($_FILES['image']['name']);
                $image_size = getimagesize($_FILES['image']['tmp_name']);
                if ($image_size == false)
                    $msg = "That's not an image.";
                else {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "assets/images/users/" . $_FILES["image"]["name"]);
                    $location = "assets/images/users/" . $_FILES["image"]["name"];
                    // $query = mysqli_query($con, "update admin set image ='$location' where ID='$_SESSION[id]'");
                    // $msg = "Image Uploaded.";

                    $ins = "UPDATE admin SET image ='$location' where id='$_SESSION[id]'";
                    if (mysqli_query ($link, $ins)) {           
                        echo "<script>";
                        echo "self.location='#?msg=<font color=green>Added Success!</font>';";
                        echo "</script>";
                    } else {
                        echo "no ins";
                    }
                }
            }
        }
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
                <span class="splash-description">
                    <?php                       
                        if (isset($_POST['name'])) {
                            if ($_POST['name'] != "") {                                        
                                
                                $name = $_POST['name'];
                                $username = $_POST['username'];
                                $mobile = $_POST['mobile'];
                                $email = $_POST['email'];
                                $pass = $_POST['password']; 
                                $ins = "UPDATE admin SET name ='$name',username ='$username',
                                        mobile ='$mobile',email ='$email',pass ='$pass'
                                        where id='$_SESSION[id]'";
                                          
                                if (mysqli_query ($link, $ins)) {
                                    echo "<script>";
                                    echo "self.location='edit_profile.php?msg=<font color=green>Update Success! Relogin Now</font>';";
                                    echo "</script>";
                                } else {
                                    echo "<script>";
                                    echo "self.location='edit_profile.php?msg=<font color=red>Not Success!</font>';";
                                    echo "</script>";
                                }

                            }           
                        }               
                    ?>
                    <?php 
                        if (isset($_GET['msg'])) {
                            echo $_GET['msg'];
                        }
                    ?>
                </span>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">My Profile</h5>
                                
                            <div class="card-body">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        
                                        <span>Name</span>
                                        <input name="name" value="<?php echo $_SESSION['n']; ?>" class="form-control form-control-lg" type="text" placeholder="Name" autocomplete="off" required>
                                        <br>
                                        <span>Mobile No.</span>
                                        <input name="mobile" value="<?php echo $_SESSION['m']; ?>" class="form-control form-control-lg" type="text" placeholder="Mobile No." autocomplete="off" required>
                                        <br>
                                        <span>Email</span>
                                        <input name="email" value="<?php echo $_SESSION['e']; ?>" class="form-control form-control-lg" type="text" placeholder="Email" autocomplete="off" required>
                                        <br>
                                        <span>Username</span>
                                        <input name="username" value="<?php echo $_SESSION['u']; ?>" class="form-control form-control-lg" type="text" placeholder="Username" autocomplete="off" required>
                                        <br>
                                        <span>Password</span>
                                        <input name="password" value="<?php echo $_SESSION['p']; ?>" class="form-control form-control-lg" type="password" placeholder="Password" autocomplete="off" required>
                                        
                                    </div>

                                    
                                    <button type="submit" name="save" class="btn btn-primary btn-lg btn-block">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>    
                    
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Profile Avatar</h5>
                                
                            <div class="card-body">

                                <div class="form-group">							
                                        <form method="put" enctype="multipart/form-data">
                                            <input type="hidden" value="1000000" name="MAX_FILE_SIZE" />
                                            <input type="file" name="image" class="form-control responsive">
                                            <button type="submit" name="upload" class="btn btn-primary responsive" ><em class="fa fa-upload"> Upload Image</em></button>																			
                                        </form>
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