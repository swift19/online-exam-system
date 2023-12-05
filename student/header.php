            
            <nav class="navbar navbar-expand-lg bg-blue fixed-top">
                <a class="navbar-brand" href="dashboard.php">
                    <img src="./assets/images/logo-stemulate.png" width=200 height=50 alt="logo-stemulate" class="img-rounded">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
               
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">                                   
                                        <i class="fas fa-regular fa-user mr-2"></i>
                                        <a href="edit_profile.php" style="color:unset">My Profile</a>
                                    </h5>
                                    <span class="status"></span><span class="ml-2">Online</span>
                                </div>
                                <a class="dropdown-item" onclick="openPDF()"><i class="fas fa-book mr-2"></i>KBA</a>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-xs-12 mobile">
                        <ul class="navbar-nav ml-auto navbar-right-top">
                            <li class="nav-item dropdown nav-user">
                                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink" 
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" 
                                    aria-labelledby="navbarDropdownMenuLink">
                                    <div class="nav-user-info">
                                        <h5 class="mb-0 text-white nav-user-name">                                   
                                            <i class="fas fa-regular fa-user mr-2"></i>
                                            <a href="edit_profile.php" style="color:unset">My Profile</a>
                                        </h5>
                                        <span class="status"></span><span class="ml-2">Online</span>
                                    </div>
                                    <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                </div>
            </nav>

<script>
    function openPDF() {
        // Provide the path to your PDF file
        var pdfPath = 'assets/student-kba.pdf';

        // Open the PDF in a new tab or window
        window.open(pdfPath, '_blank');
    }
</script>