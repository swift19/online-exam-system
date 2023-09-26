<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="./assets/libs/css/main.css">
</head>
<body>

<?php
session_start(); 
include 'db.php';
if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['email'];
  $query = mysqli_query($link,"select email from student where email='$email'");
  $data = mysqli_num_rows($query);
  
  if($data > 0)
  {
    $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a password reset request for your account.</p>
     <br>
     <p><button class="btn btn-primary"><a href="http://localhost/online-exam-system/student/password-reset.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
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
    $msg = "We can't find a student with that email address";
  }
}

?>
    <!-- ============================================================== -->
    <!-- forgot password page  -->
    <!-- ============================================================== -->
  <div class="login-container">
    <div class="logos-container">
      <!-- logo header -->
      <div class="logo-fixed">
        <img src="./assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate" class="img-rounded">
      </div>
      
      <img src="./assets/images/stemulate-home.png" width=80 height=250 alt="stemulate-home" class="img-rounded">
    </div>
    <div class="login-form">
      <p class="welcome-header">Forgot Password</p>
      <form method="post">
        <span class="splash-description">
          <?php if(!empty($msg)){ echo $msg; } ?>
        </span>
        </br>
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email" placeholder="Enter your Email address" 
          data-parsley-type="email" data-parsley-trigger="keyup" class="rounded-input" required>
        </br>
        <button type="submit" name="pwdrst" class="primary-button">Reset Password</button>
      </form>
      <p class="sub-content">Already have an existing account?<a href="index.php">Click here</a></p>

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
