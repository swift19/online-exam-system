<?php
// Getting active directory
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[3];
// var_dump($page); -- for checking/debugging

$noImage = "https://placehold.it/150/30a5ff/fff";
?>
<?php if ($_SESSION['u']==='superadmin') { ?>
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Teacher List</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <br/>
                            <img src="<?php if ($_SESSION['i']) {
                                    echo $_SESSION['i'];
                            } else { echo $noImage; } ?>" class="img-responsive desktop-image" width="125px" height="125px" alt="image" class="responsive">									
    
                            <li class="nav-divider">Menu</li>
                            
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "sa_teacher_list.php"){ echo "active"; } ?>" href="sa_teacher_list.php"> <i class="fab fa-fw fa-wpforms"></i>Teacher List </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "sa_student_list.php"){ echo "active"; } ?>" href="sa_student_list.php"><i class="fab fa-fw fa-wpforms"></i>Student List</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "logout.php"){ echo "active"; } ?>" href="logout.php"><i class="fab fa-fw fas fa-power-off"></i>Logout</a>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        

            <?php  } else { ?>

            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <br/>
                            <img src="<?php if ($_SESSION['i']) {
                                    echo $_SESSION['i'];
                            } else { echo $noImage; } ?>" class="img-responsive desktop-image" width="125px" height="125px" alt="image" class="responsive">									
    
                            <li class="nav-divider">Menu</li>
                            
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "dashboard.php"){ echo "active"; } ?>" href="dashboard.php"> <i class="fab fa-fw fa-wpforms"></i>Dashboard </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "vdo_list.php"){ echo "active"; } ?>" href="vdo_list.php"><i class="fab fa-fw fa-wpforms"></i>Video List </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "semester_list.php"){ echo "active"; } ?>" href="semester_list.php"><i class="fab fa-fw fa-wpforms"></i>Semester List </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "subject_list.php"){ echo "active"; } ?>" href="subject_list.php"><i class="fab fa-fw fa-wpforms"></i>Subject List </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "experiment_list.php"){ echo "active"; } ?>" href="experiment_list.php"><i class="fab fa-fw fa-wpforms"></i>Experiment List</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "exam_list.php"){ echo "active"; } ?>" href="exam_list.php"><i class="fab fa-fw fa-wpforms"></i>Exam List</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "pdf_list.php"){ echo "active"; } ?>" href="pdf_list.php"><i class="fab fa-fw fa-wpforms"></i>PDF Files</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "student_list.php"){ echo "active"; } ?>" href="student_list.php"><i class="fab fa-fw fa-wpforms"></i>Student List</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "edit_profile.php"){ echo "active"; } ?>" href="edit_profile.php"><i class="fab fa-fw fa-wpforms"></i>My Profile</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "logout.php"){ echo "active"; } ?>" href="logout.php"><i class="fab fa-fw fas fa-power-off"></i>Logout</a>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>

            <?php  } ?>