<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="./assets/libs/css/main.css">
</head>
<body>
<?php
session_start(); 
include 'db.php';
if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['email'];
  $pwd = $_REQUEST['pwd'];
  $cpwd = $_REQUEST['cpwd'];
  if($pwd == $cpwd)
  {
    $reset_pwd = mysqli_query($link,"update student set pass='$pwd' where email='$email'");
    if($reset_pwd > 0)
    {
      $msg = 'Your password updated successfully';
    }
    else
    {
      $msg = "Error while updating password.";
    }
  }
  else
  {
    $msg = "Password and Confirm Password do not match";
  }
}

if($_GET['secret'])
{
  $email = base64_decode($_GET['secret']);
  $query = mysqli_query($link,"select email from student where email='$email'");
  $data = mysqli_num_rows($query);
  if($data > 0)
    { ?>

    <!-- ============================================================== -->
    <!-- reset password page  -->
    <!-- ============================================================== -->
  <div class="login-container">
    <div class="logos-xs-container">
      <img src="./assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate">
    </div>
    <div class="logos-container">
      <!-- logo header -->
      <div class="logo-fixed">
        <img src="./assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate">
      </div>
      
      <img src="./assets/images/stemulate-home.png" width=80 height=250 alt="stemulate-home">
    </div>
    <div class="login-form">
      <p class="welcome-header">Reset Password</p>
      <form id="validate_form" method="post">
        <span class="splash-description">
          <?php if(!empty($msg)){ echo $msg; } ?>
        </span>
        </br>
        <input type="hidden" name="email" value="<?php echo $email; ?>"/>
        <label for="pwd">New Password</label>
        <input type="password" name="pwd" id="pwd" placeholder="Enter your New Password" 
          data-parsley-type="pwd" data-parsley-trigger="keyup" class="rounded-input" required>
        
        <label for="cpwd">Confirm Password</label>
        <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" 
          data-parsley-type="cpwd" data-parsley-trigger="keyup" class="form-control" required/>
        </br>
        <button type="submit" name="pwdrst" class="primary-button">Submit</button>
      </form>
      <p class="sub-content">Go back home?<a href="index.php">Click here</a></p>

    </div>
  </div>

    <!-- ============================================================== -->
    <!-- end reset password page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <?php } } ?>
</body>
</html>
