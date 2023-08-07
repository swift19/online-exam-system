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
    <div class="logos-container">
      <!-- logo header -->
      <div class="logo-fixed">
        <img src="./assets/images/stemulate.png" width="120" height="120" alt="stemulate" class="img-rounded">
      </div>
    </div>
    <div class="registration-form">
    <?php
                        include 'db.php';
                        if (isset($_POST['name'])) {
                            if ($_POST['name'] != "") {                                        
                                
                                $studentid = $_POST['studentid'];
                                $name = $_POST['name'];
                                $dept = $_POST['dept'];
                                $phoneno = $_POST['phoneno'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $address = $_POST['address'];
                                $ins = "INSERT INTO student (studentid, name, dept, phoneno, email, pass, address, status) 
                                        VALUES ('$studentid', '$name', '$dept', '$phoneno', '$email', '$password', '$address', '1');";    
                
                                if (mysqli_query ($link, $ins)) {           
                                    echo "<script>";
                                    echo "self.location='index2.php?msg=<font color=green>Registration Success! Login Now</font>';";
                                    echo "</script>";
                                } else {
                                    echo "<script>";
                                    echo "self.location='registration2.php?msg=<font color=red>Not Success!</font>';";
                                    echo "</script>";
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
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your Email" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your Address" class="rounded-input" required>
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
            <a href="index2.php" class="secondary-button">Cancel</a>
          </div>
          <div class="form-row">
            <p class="sub-content">Already have an existing account?<a href="index2.php">Click here</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
