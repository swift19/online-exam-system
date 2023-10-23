<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Password Reset</title>
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
  $pwd = $_REQUEST['pwd'];
  $cpwd = $_REQUEST['cpwd'];
  if($pwd == $cpwd)
  {
    $reset_pwd = mysqli_query($link,"update admin set pass='$pwd' where email='$email'");
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
  $query = mysqli_query($link,"select email from admin where email='$email'");
  $data = mysqli_num_rows($query);
  if($data > 0)
    { ?>
    <!-- ============================================================== -->
    <!-- Password reset page  -->
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
                    <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                    <label for="pwd">New Password</label>
                    <input type="password" name="pwd" id="pwd" placeholder="Enter your New Password" 
                      data-parsley-type="pwd" data-parsley-trigger="keyup" class="form-control" required>
                    </br>
                    <label for="cpwd">Confirm Password</label>
                    <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" 
                      data-parsley-type="cpwd" data-parsley-trigger="keyup" class="form-control" required/>
                    </br>
                    </div>
                    <button type="submit" name="pwdrst" class="btn btn-primary btn-lg btn-block">Submit</button>
                </form>
                <br><a href="index.php">Back</a>
            </div>
            
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end password reset page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <?php } } ?>
</body>
 
</html>