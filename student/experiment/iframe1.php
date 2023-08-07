<?php 
    session_start(); 
    if ($_SESSION['p'] != "") {
?>
<!doctype html>
<html lang="en">
<head>
<style>
    .responsive-iframe {
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      border: none;
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
      height: 55px; /* Adjust the height of the background as needed */
      background-color: #f0f0f0; /* Set the background color to your desired color */
    }
</style>
</head>
<body>

<div class="iframe-container">
    <div class="preloader"></div>
    <iframe class="responsive-iframe" 
      src="https://phet.colorado.edu/sims/html/density/latest/density_en.html">
    </iframe>
</div>

   
<script>
	window.onload = function(){
    // hide the preloader with timeout 10sec
		setTimeout(function(){
			document.querySelector(".preloader").style.display = "none";
		}, 10000)
  }
</script>

</body>
</html>
<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>