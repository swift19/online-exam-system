<?php 
    session_start();     
    include 'db.php';   
    $noImage = "https://placehold.it/150/30a5ff/fff";
    if ($_SESSION['p'] != "") {
        
        $query = mysqli_query($link, "select * from student where id='$_SESSION[id]'");
        while($data = mysqli_fetch_array($query))
        {
            $_SESSION['id'] = $data['id'];
			$_SESSION['si'] = $data['studentid'];
			$_SESSION['n'] = $data['name'];
			$_SESSION['d'] = $data['dept'];
            $_SESSION['pn'] = $data['phoneno'];
			$_SESSION['e'] = $data['email'];
			$_SESSION['p'] = $data['pass'];
            $_SESSION['a'] = $data['address'];
			$_SESSION['s'] = $data['status'];
			$_SESSION['i'] = $data['image'];
            $_SESSION['cp'] = $data['conPerson'];
            $_SESSION['cn'] = $data['conNumber'];
            $_SESSION['ca'] = $data['conAddress'];
        }
?>
<!doctype html>
<html lang="en">
 
<head>
    <?php include 'head.php'; ?>
</head>

<body>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var profilePicture = document.getElementById('profile_picture');
            var profilePictureInput = document.getElementById('profile_picture_input');
           
            profilePicture.addEventListener('click', function() {
                profilePictureInput.click();
            });

            profilePictureInput.addEventListener('change', function() {
                var file = profilePictureInput.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    profilePicture.src = e.target.result;
                };

                reader.readAsDataURL(file);
            });
        });

        function reloadPage() {
            location.reload();
        }
        function goBackPage() {
            location.back();
        }
    </script>
    <div class="dashboard-main-wrapper">
        
         <div class="dashboard-header">
            <?php include 'header.php';  ?>
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
                                
                                        $ins = "UPDATE student SET image ='$location' where id='$_SESSION[id]'";
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
                            $studentid = $_POST['studentid'];
                            $name = $_POST['name'];
                            $dept = $_POST['dept'];
                            $phoneno = $_POST['phoneno'];
                            $email = $_POST['email'];
                            $pass = $_POST['password']; 
                            $address = $_POST['address'];
                            $conPerson = $_POST['conPerson'];
                            $conNumber = $_POST['conNumber'];
                            $conAddress = $_POST['conAddress'];

                            if ($_POST['name'] != "") {                      

                                if(strpos($email, '@gmail.com') !== false){
                                    $ins = "UPDATE student SET 
                                    studentid ='$studentid',
                                    name ='$name',
                                    dept ='$dept',
                                    phoneno ='$phoneno',
                                    email ='$email',
                                    pass ='$pass',
                                    address ='$address',
                                    conPerson ='$conPerson',
                                    conNumber ='$conNumber',
                                    conAddress ='$conAddress'
                                    WHERE id='$_SESSION[id]'";
                                      
                                    if (mysqli_query ($link, $ins)) {
                                        echo "<script>";
                                        echo "self.location='edit_profile.php?msg=<font color=green>Update Profile Success!</font>';";                                                                        
                                        echo "</script>";                                    
                                    } else {
                                        echo "<script>";
                                        echo "self.location='edit_profile.php?msg=<font color=red>Not Success!</font>';";
                                        echo "</script>";
                                    }
                            
                                } else {
                                    echo "<script>";
                                    echo "self.location='edit_profile.php?msg=<font color=red>Invalid Email address!</font>';";
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
                <div class="">
                    
                    <div class="card-ep">
                            <div class="card">
                                <div class="card-header">
                                <div class="row goback">
                                    <div class="col-md-6">
                                        <h5>My Profile</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="dashboard.php" class="fa fa-angle-left">&nbsp;Go back</a>
                                    </div>
                                </div>
                                   
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-md-2">
                                        <div class="avatar-ep">
                                            <form method="post" enctype="multipart/form-data">
                                                <input id="profile_picture_input" type="file" class="form-control responsive" name="image" required>                          
                                                    <img id="profile_picture" src="<?php if ($_SESSION['i']) {
                                                            echo $_SESSION['i'];
                                                        } else { echo $noImage; } ?>"  
                                                        width="125px" height="125px" alt="image">
                                                    <button type="submit" name="upload" class="upload-button fa fa-upload"></button>
                                            </form>
                                        </div>
                                    </div> 
                                   
                                    
                                    <div class="col-md-10">
                                        <form action="#" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-ep">
                                                        <span>LRN ID</span>
                                                        <input name="studentid" oninput="validateAlphanumeric(this)" value="<?php echo $_SESSION['si']; ?>" class="form-control-ep form-control-lg" type="text" placeholder="LRN ID"   required>
                                                    </div>
                                                    <div class="form-group-ep">
                                                        <span>Full Name</span>
                                                        <input name="name" value="<?php echo $_SESSION['n']; ?>" class="form-control-ep form-control-lg" type="text" placeholder="Name"  required>
                                                    </div>
                                            
                                                    <div class="form-group-ep">
                                                        <span>Section</span>
                                                        <select class="form-control-ep form-control-lg" id="dept" name="dept">
                                                            <option value="<?php echo $_SESSION['d']; ?>"><?php echo $_SESSION['d']; ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group-ep">
                                                        <span>Phone No.</span>
                                                        <input name="phoneno" value="<?php echo $_SESSION['pn']; ?>" class="form-control-ep form-control-lg" type="text" placeholder="Phone No."  required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-ep">
                                                        <span>Email</span>
                                                        <input name="email" oninput="validateEmail(this)" value="<?php echo $_SESSION['e']; ?>" class="form-control-ep form-control-lg" type="text" placeholder="Email"  required>
                                                        <p id="emailError" style="color: red; font-size: 12px; margin: unset;"></p>
                                                    </div>
                                                    <div class="form-group-ep">
                                                        <span>Address</span>
                                                        <input name="address" value="<?php echo $_SESSION['a']; ?>" class="form-control-ep form-control-lg" type="text" placeholder="Address"  required>
                                                    </div>
                                                    <div class="form-group-ep password-container ">
                                                        <span>Password</span>
                                                        <input type="password" id="password" name="password"  minlength="8" value="<?php echo $_SESSION['p']; ?>" class="form-control-ep form-control-lg" placeholder="Password"  required>
                                                        <span class="password-toggle edit" onclick="togglePassword()">👁️</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <span>Emergency Contact Details</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-ep">
                                                        <span>Contact Person</span>
                                                        <input name="conPerson" value="<?php echo $_SESSION['cp']; ?>" class="form-control-ep form-control-lg" type="text" placeholder="Contact Person"  required>
                                                    </div>
                                                    <div class="form-group-ep">
                                                        <span>Contact No.</span>
                                                        <input name="conNumber" value="<?php echo $_SESSION['cn']; ?>" class="form-control-ep form-control-lg" type="text" placeholder="Contact No" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-ep">
                                                        <span>Contact Address</span>
                                                        <input name="conAddress" value="<?php echo $_SESSION['ca']; ?>" class="form-control-ep form-control-lg" type="text" placeholder="Contact Address" required>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <button type="submit" name="save" class="button-submit btn btn-primary btn-lg btn-block" onclick="reloadPage()">Save</button>
                                        </form>
                                    </div> 
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
    <script>
        function validateAlphanumeric(input) {
            input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');
        }
        function validateEmail(input) {
            const email = input.value;
            const emailError = document.getElementById('emailError');

            if (!input.checkValidity()) {
                emailError.textContent = 'Please enter a valid email address.';
                input.classList.add('invalid-email');
            } else if (email.indexOf('@gmail.com') === -1) {
                emailError.textContent = 'Please enter a Gmail address.';
                input.classList.add('invalid-email');
            } else {
                emailError.textContent = '';
                input.classList.remove('invalid-email');
            }
        }
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.textContent = '👁️';
            } else {
                passwordInput.type = 'password';
                passwordToggle.textContent = '👁️';
            }
        }
        fetch('sections.json')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('dept');
            const filteredData = data.slice(1);
            // Populate select options
            filteredData.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.value;
                optionElement.text = option.label;
                select.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Error fetching sections.json:', error));
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