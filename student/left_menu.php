<?php
// Getting active directory
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[3];
// var_dump($page); -- for checking/debugging
?>
<div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">Menu</li>
                            
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "dashboard.php"){ echo "active"; } ?>" href="dashboard.php"> <i class="fab fa-fw fa-wpforms"></i>Dashboard </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "learnings.php"){ echo "active"; } ?>" href="learnings.php"> <i class="fab fa-fw fa-wpforms"></i>Experiment </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php if($page == "result.php"){ echo "active"; } ?>" href="result.php"> <i class="fab fa-fw fa-wpforms"></i>Results </a>
                            </li>
                            

                            
                        </ul>
                    </div>
                </nav>
            </div>