<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- registration page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center bg-blue"><a href="registration.php"><img class="logo-img" src="assets/images/logo-stemulate.png" alt="logo"></a>
                <span class="splash-description">
                    <?php
                        include 'db.php';
                        if (isset($_POST['name'])) {
                            if ($_POST['name'] != "") {                                        
                                
                                $email = $_POST['email'];
                                $query = mysqli_query($link, "select * from admin where email = '$email'");
                                var_dump("qqqq" , mysqli_num_rows($query));
                                if(filter_var($email, FILTER_VALIDATE_EMAIL)  && mysqli_num_rows($query) < 1){
                                    $name = $_POST['name'];
                                    $username = $_POST['username'];
                                    $mobile = $_POST['mobile'];
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];
                                    $address = $_POST['address'];
                                    $ins = "INSERT INTO admin (name,username, mobile, email, pass, status) 
                                            VALUES ('$name','$username','$mobile', '$email', '$password', '0');";    
    
                                        
                                    $message = 
                                    '<div>
                                        <div style="background: linear-gradient(180deg, #2D46B9 0%, #1E3163 100%);  ">
                                            <img src="http://localhost/online-exam-system/admin/assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate">
                                        </div>
                                        <br>
                                        <p><b>Hello!</b></p>
                                        <p>Thank you for registering with STEMulate! We are thrilled to welcome you to our community. To complete your registration and activate your account, please click the button below:</p>
                                        <br>
                                        <p><button class="btn btn-primary"><a href="http://localhost/online-exam-system/admin/verify.php?secret='.base64_encode($email).'">Verify Account</a></button></p>
                                        <br>
                                        <p>Once your account is activated, you will have full access to all the exciting features on our website. If you have any questions or need assistance, feel free to reach out to our support team at <a href="">stemulate03@gmail.com</a>.</p>
                                        <br>
                                        <p>Best regards,</p>
                                        <p>The STEMulate Team</p>
                                    </div>';

                                    include_once("./../student/SMTP/class.phpmailer.php");
                                    include_once("./../student/SMTP/class.smtp.php");
                                    $email = $email; 
                                    $mail = new PHPMailer;
                                    $mail->IsSMTP();
                                    $mail->SMTPAuth = true;                 
                                    $mail->SMTPSecure = "tls";      
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->Port = 587; 
                                    $mail->Username = "stemulate03@gmail.com";
                                    $mail->Password = "waci hjgj dney shgn";
                                    $mail->FromName = "SteMulate Admin";
                                    $mail->AddAddress($email);
                                    $mail->Subject = "Verify Account";
                                    $mail->isHTML( TRUE );
                                    $mail->Body =$message;
                                    
                                    if (mysqli_query ($link, $ins) & $mail->send()) {           
                                        echo "<script>";
                                        echo "self.location='index.php?msg=<font color=green>Registration Success! Please check your email</font>';";
                                        echo "</script>";
                                    } else {
                                        echo "<script>";
                                        echo "self.location='registration.php?msg=<font color=red>Not Success!</font>';";
                                        echo "</script>";
                                    }
                                } else {
                                    echo "<script>";
                                    echo "self.location='registration.php?msg=<font color=red>Email is already used! Please try other email</font>';";
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
            </div>
            <div class="card-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <input name="name" class="form-control form-control-lg" id="name" type="text" placeholder="Name" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="mobile" class="form-control form-control-lg" id="mobile" type="text" placeholder="Mobile No." autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control form-control-lg" id="email" type="email" placeholder="Email (gmail account only)" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="username" class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="password" class="form-control form-control-lg"  minlength="8" id="password" type="password" placeholder="Password" required>
                    </div>
                    
                    <button type="submit" name="save" class="btn btn-primary btn-lg btn-block">Submit</button>
                </form>
                <br><a href="index.php">Back</a>
            </div>
            
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end registration page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>