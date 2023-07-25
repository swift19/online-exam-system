<!DOCTYPE html>
<html>
<head>

<title>Log Out</title>
</head>

<body>
<?php
	session_start();
    session_destroy();
	
	
		echo "<script>";
		echo "self.location='index.php?msg=<font color=green>Log Out Successful.</font>';";
		echo "</script>";
	
?>
</body>
</html>