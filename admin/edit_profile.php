<?php 
    session_start();     
    include 'db.php';   
    if ($_SESSION['p'] != "") {
        
        $query = mysqli_query($link, "select * from admin where id='$_SESSION[id]'");
        while($data = mysqli_fetch_array($query))
        {
            $_SESSION['id'] = $data['id'];
			$_SESSION['u'] = $data['username'];
			$_SESSION['n'] = $data['name'];
			$_SESSION['m'] = $data['mobile'];
			$_SESSION['e'] = $data['email'];
			$_SESSION['p'] = $data['pass'];
			$_SESSION['s'] = $data['status'];
			$_SESSION['i'] = $data['image'];
        }
?>
<!doctype html>
<html lang="en">
 
<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <script>
        function reloadPage() {
            location.reload();
        }
    </script>
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
                        // Upload Image
                        if (isset($_POST['upload'])) {

                            if (!isset($_FILES['image']['tmp_name'])) {
                                $msg = "Please select an image.";
                            } else {
                                $file = $_FILES['image']['tmp_name'];
                                $image_name = addslashes($_FILES['image']['name']);
                                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_size = getimagesize($_FILES['image']['tmp_name']);
                                
                                $allowedFormats = array("jpg", "jpeg", "png", "gif");
                                $maxFileSize = 5000000; // 5MB (in bytes)
                            

                                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                                    $file = $_FILES['image']['tmp_name'];
                                    $image_name = $_FILES['image']['name'];
                                    $image_size = $_FILES['image']['size'];
                                    $image_type = $_FILES['image']['type'];
                                
                                    $allowedFormats = array("image/jpeg", "image/png", "image/gif");
                                    $maxFileSize = 5000000; // 5MB (in bytes)
                                
                                    if (!in_array($image_type, $allowedFormats)) {
                                        echo '<script language="javascript">';
                                        echo 'alert("Only JPG, JPEG, PNG, and GIF formats are allowed.")';
                                        echo '</script>';
                                    } elseif ($image_size > $maxFileSize) {
                                        echo '<script language="javascript">';
                                        echo 'alert("File size is too large. Please choose a smaller image.")';
                                        echo '</script>';
                                    } else {
                                        move_uploaded_file($_FILES["image"]["tmp_name"], "assets/images/users/" . $_FILES["image"]["name"]);
                                        $location = "assets/images/users/" . $_FILES["image"]["name"];
                                
                                        $ins = "UPDATE admin SET image ='$location' where id='$_SESSION[id]'";
                                        if (mysqli_query ($link, $ins)) {           
                                            echo "<script>";
                                            echo "self.location='edit_profile.php?msg=<font color=green>Update Image Success!</font>';";
                                            echo "</script>";                                       
                                        } else {
                                            echo "<script>";
                                            echo "self.location='edit_profile.php?msg=<font color=red>Not Success!</font>';";
                                            echo "</script>";
                                        }
                                    }
                                } else {
                                    echo '<script language="javascript">';
                                    echo 'alert("Please select an image.")';
                                    echo '</script>';
                                }
                            }
                            
                        }
                        // Update Profile
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
                                    echo "self.location='edit_profile.php?msg=<font color=green>Update Profile Success!</font>';";                                                                        
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

                                    
                                    <button type="submit" name="save" class="btn btn-primary btn-lg btn-block" onclick="reloadPage()">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>    
                    
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Profile Avatar</h5>
                                
                            <div class="card-body">

                                <div class="form-group">							
                                        <form method="post" enctype="multipart/form-data">                                            
                                            <input type="file" name="image" class="form-control responsive" accept="image/*" required>
                                            <br/>
                                            <button type="submit" name="upload" class="btn btn-primary responsive" onclick="reloadPage()"><em class="fa fa-upload"> Upload Image</em></button>																			
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