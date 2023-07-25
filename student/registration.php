<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student Registration</title>
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
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="registration.php"><img class="logo-img" src="assets/images/admin_logo.png" alt="logo"></a>
                <span class="splash-description">
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
                                    echo "self.location='index.php?msg=<font color=green>Registration Success! Login Now</font>';";
                                    echo "</script>";
                                } else {
                                    echo "<script>";
                                    echo "self.location='registration.php?msg=<font color=red>Not Success!</font>';";
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
                        <input name="studentid" class="form-control form-control-lg" id="username" type="text" placeholder="Student ID" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="name" class="form-control form-control-lg" id="username" type="text" placeholder="Name" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="dept" class="form-control form-control-lg" id="username" type="text" placeholder="Dept." autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="phoneno" class="form-control form-control-lg" id="username" type="text" placeholder="Phone No." autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control form-control-lg" id="username" type="text" placeholder="Email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input name="password" class="form-control form-control-lg" id="password" type="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input name="address" class="form-control form-control-lg" id="username" type="text" placeholder="Address" autocomplete="off" required>
                    </div>
                    
                    <button type="submit" name="save" class="btn btn-primary btn-lg btn-block">Submit</button>
                </form>
                <br><a href="index.php">Back</a>
            </div>
            
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