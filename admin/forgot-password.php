<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Forgot Password</title>
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
<?php
session_start(); 
include 'db.php';
if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['email'];
  $query = mysqli_query($link,"select email from admin where email='$email'");
  $data = mysqli_num_rows($query);
  
  if($data > 0)
  {
    $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a password reset request for your account.</p>
     <br>
     <p><button class="btn btn-primary"><a href="http://localhost/online-exam-system/admin/password-reset.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
     <br>
     <p>If you did not request a password reset, no further action is required.</p>
    </div>';

    include_once("SMTP/class.phpmailer.php");
    include_once("SMTP/class.smtp.php");
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
    $mail->Subject = "Reset Password";
    $mail->isHTML( TRUE );
    $mail->Body =$message;
    if($mail->send())
    {
      $msg = "We have e-mailed your password reset link!";
    }
  } else {
    $msg = "We can't find a teacher with that email address";
  }
}

?>
    <!-- ============================================================== -->
    <!-- Forgot password page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center bg-blue"><a href="#"><img class="logo-img" src="assets/images/logo-stemulate.png" alt="logo"></a>
                <span class="splash-description">
                    <?php if(!empty($msg)){ echo $msg; } ?>
                </span>
            </div>
            <div class="card-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <input name="email" class="form-control form-control-lg" id="email" type="email" placeholder="Email (gmail account only)" autocomplete="off" required>
                    </div>
                    <button type="submit" name="pwdrst" class="btn btn-primary btn-lg btn-block">Reset Password</button>
                </form>
                <br><a href="index.php">Back</a>
            </div>
            
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end forgot password page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>