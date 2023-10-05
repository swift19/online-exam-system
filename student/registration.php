<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration</title>
  <link rel="stylesheet" href="./assets/libs/css/main.css">
</head>
<body>
  <div class="login-container">
    <div class="logos-xs-container">
      <img src="./assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate">
    </div>
    <div class="logos-container">
      <!-- logo header -->
      <div class="logo-fixed">
        <img src="./assets/images/stemulate.png" width="120" height="120" alt="stemulate">
      </div>
    </div>
    <div class="registration-form">
    <?php
                        include 'db.php';
                        if (isset($_POST['name'])) {
                            if ($_POST['name'] != "") {                                        
                                
                              $email = $_POST['email'];
                              if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                                $studentid = $_POST['studentid'];
                                $name = $_POST['name'];
                                $dept = $_POST['dept'];
                                $phoneno = $_POST['phoneno'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $address = $_POST['address'];
                                $ins = "INSERT INTO student (studentid, name, dept, phoneno, email, pass, address, status) 
                                        VALUES ('$studentid', '$name', '$dept', '$phoneno', '$email', '$password', '$address', '0');";    
                
                    
                                $message = '<div>
                                    <p><b>Hello!</b></p>
                                    <p>Thank you for registering with STEMulate! We are thrilled to welcome you to our community. To complete your registration and activate your account, please click the button below:</p>
                                    <br>
                                    <p><button class="btn btn-primary"><a href="http://localhost/online-exam-system/student/verify.php?secret='.base64_encode($email).'">Verify Account</a></button></p>
                                    <br>
                                    <p>Once your account is activated, you will have full access to all the exciting features on our website. If you have any questions or need assistance, feel free to reach out to our support team at <a href="">stemulate03@gmail.com</a>.</p>
                                    <br>
                                    <p>Best regards,</p>
                                    <p>The STEMulate Team</p>
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
                                $mail->Subject = "Verify Account - Student";
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
                              }

                            }           
                        }               
                    ?>
                    
      <h1 class="welcome-header reg">Create New Account</h1>
      <form action="#" method="post">
        <span class="splash-description">
                    <?php 
                        if (isset($_GET['msg'])) {
                            echo $_GET['msg'];
                        }
                    ?>
        </span>            
        <br/><br/><br/>
        <div class="form-grid">
          <div class="form-row">
            <label for="full-name">Full Name:</label>
            <input type="text" id="full-name" name="name" placeholder="Enter your Full Name" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="dept">Department:</label>
            <input type="text" id="dept" name="dept" placeholder="Enter your Department" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="phoneno">Phone no:</label>
            <input type="text" id="phoneno" name="phoneno" placeholder="Enter your Phone no" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="studentid">Student id:</label>
            <input type="number" id="studentid" name="studentid" placeholder="Enter your Student ID" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="email">Email: (Gmail account only)</label>
            <input type="email" id="email" name="email" placeholder="Enter your Email Address" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your Full Address" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" class="rounded-input" required>
          </div>
          <div class="form-row">
            &nbsp;
          </div>
          <div class="form-row">
            <button type="submit" class="primary-button">Create Account</button>
          </div>
          <div class="form-row">
            <a href="index.php" class="secondary-button">Cancel</a>
          </div>
          <div class="form-row">
            <p class="sub-content">Already have an existing account?<a href="index.php">Click here</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
