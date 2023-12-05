<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login</title>
  <link rel="stylesheet" href="./assets/libs/css/main.css">
</head>
<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
  <div class="login-container">
    <div class="logos-xs-container">
      <img src="./assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate">
    </div>
    
    <div class="logos-container">
      <!-- logo header -->
      <div class="logo-fixed">
        <img src="./assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate" class="img-rounded">
      </div>
      
      <img src="./assets/images/stemulate-home.png" width=80 height=250 alt="stemulate-home" class="img-rounded">
    </div>
    <div class="login-form">
      <p class="welcome-header">Welcome!</p>
      <form action="chk.php" method="post">
        <span class="splash-description">
                    <?php 
                        if (isset($_GET['msg'])) {
                            echo $_GET['msg'];
                        }
                    ?>
        </span>
        <br/>
        <label for="student-no">LRN ID:</label>
        <input type="text" name="studentid" id="student-no" placeholder="Enter your LRN ID." class="rounded-input" required>
        <br/>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" class="rounded-input" required>
        <br/>
        <button type="submit" class="primary-button">Login</button>
        <a href="registration.php" class="secondary-button">Create New Account</a>
      </form>
      <p class="sub-content"><a href="../">Go back</a> | Forgot your password? <a href="forgot-password.php">Click here</a>  </p>
    </div>
  </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
