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
                              $query = mysqli_query($link, "select * from student where email = '$email'");

                              if(filter_var($email, FILTER_VALIDATE_EMAIL) && mysqli_num_rows($query) < 1){
                                $studentid = $_POST['studentid'];
                                $name = $_POST['name'];
                                $dept = $_POST['dept'];
                                $phoneno = $_POST['phoneno'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $address = $_POST['address'];
                                $conPerson = $_POST['conPerson'];
                                $conNumber = $_POST['conNumber'];
                                $conAddress = $_POST['conAddress'];
                                
                                $ins = "INSERT INTO student (studentid, name, dept, phoneno, email, pass, address, status,conPerson,conNumber,conAddress) 
                                        VALUES ('$studentid', '$name', '$dept', '$phoneno', '$email', '$password', '$address', '0','$conPerson','$conNumber','$conAddress');";    
                
                    
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
                              } else {
                                echo "<script>";
                                echo "self.location='registration.php?msg=<font color=red>Email is already used! Please try other email</font>';";
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
        <br/>
        <div class="form-grid">
          <div class="form-row">
            <label for="full-name">Full Name:</label>
            <input type="text" id="full-name" name="name" placeholder="Enter your Full Name" class="rounded-input" required>
          </div>
    
          <div class="form-row">
            <label for="section">Section:</label>
            <select class="form-control section" id="dept" name="dept">
            </select>
          </div>

          <div class="form-row">
            <label for="phoneno">Phone no:</label>
            <input type="text" id="phoneno" name="phoneno" placeholder="Enter your Phone no" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="studentid">LRN ID:</label>
            <input type="text" id="studentid" name="studentid" placeholder="Enter your LRN ID" class="rounded-input"  oninput="validateAlphanumeric(this)" required>
          </div>
          <div class="form-row">
            <label for="email">Email: (Gmail account only)</label>
            <input type="email" id="email" name="email" placeholder="Enter your Email Address" class="rounded-input" oninput="validateEmail(this)" required>
            <p id="emailError" style="color: red;font-size:12px; margin: unset;"></p>
          </div>
          <div class="form-row">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your Full Address" class="rounded-input" required>
          </div>
          <div class="form-row password-container ">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"  minlength="8"  placeholder="Enter your Password" class="rounded-input" required>
            <span class="password-toggle" onclick="togglePassword()">👁️</span>
          </div>
          <div class="form-row">
            <label for="address">Emergency Contact Person:</label>
            <input type="text" id="conPerson" name="conPerson" placeholder="Enter your Contact Person" class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="address">Emergency Contact No.:</label>
            <input type="text" id="conNumber" name="conNumber" placeholder="Enter your Contact No." class="rounded-input" required>
          </div>
          <div class="form-row">
            <label for="address">Emergency Contact Address:</label>
            <input type="text" id="conAddress" name="conAddress" placeholder="Enter your Contact Person Address" class="rounded-input" required>
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
            // Populate select options
            data.forEach(option => {
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

