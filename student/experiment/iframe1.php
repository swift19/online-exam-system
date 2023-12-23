<?php 
    session_start(); 
    if ($_SESSION['p'] != "") {
      if (isset($_SESSION['url'])) {
        $experimentUrl = $_SESSION['url'];
        $custom = $_SESSION['custom'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .preloader {
            background: #191f26 url(preloader.gif) no-repeat center center;
            background-size: 50%;
            height: 100vh;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio (9 / 16 = 0.5625) */
        }

        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Add background to the bottom of the iframe */
        .iframe-container::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 15px; /* Adjust the height of the background as needed for mobile view */
            background-color: #f0f0f0; /* Set the background color to your desired color */
        }

        @media screen and (min-width: 768px) {
            .iframe-container::after {
                height: 55px; /* Adjust the height for larger screens */
            }
        }
    </style>
</head>
<body>

    <div class="preloader"></div>

    <div class="iframe-container">
        <iframe class="responsive-iframe" src="<?php echo $experimentUrl; ?>" allowfullscreen></iframe>
        <?php if ($custom): ?>
            <style>
                .iframe-container::after {
                    height: unset !important;
                }
            </style>
        <?php endif; ?>
    </div>

    <script>
        window.onload = function() {
            // hide the preloader with timeout 10sec
            setTimeout(function() {
                document.querySelector(".preloader").style.display = "none";
            }, 10000);
        }
    </script>

</body>
</html>
<?php 
  }
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>