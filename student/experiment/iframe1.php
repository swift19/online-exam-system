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
      top: -10px;
      left: 0;
      bottom: 0px;
      right: 0;
      width: 100%;
      height: 100%;
      border: none;
    }

    .preloader{
      background:#191f26 url(preloader.gif) no-repeat center center;
      background-size: 50%;
      height:100vh;
      width:100%;
      position:fixed;
      z-index:100;
    }
</style>
</head>
<body>
    <div class="preloader"></div>
    <iframe class="responsive-iframe" src="https://phet.colorado.edu/sims/html/mean-share-and-balance/latest/mean-share-and-balance_all.html" ></iframe>

<script>
	window.onload = function(){
    // hide the preloader with timeout 1sec
		setTimeout(function(){
			document.querySelector(".preloader").style.display = "none";
		}, 1000)
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