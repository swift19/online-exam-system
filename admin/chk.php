<?php
	
	$username = $_POST['username'];
	$pass = $_POST['password'];
	
	include 'db.php';
	$query = mysqli_query($link, "select * from admin where username = '$username' AND pass = '$pass'");
	while($data = mysqli_fetch_array($query))
	{
		$id = $data['id'];
		$u  = $data['username'];
		$n  = $data['name'];
		$m  = $data['mobile'];
		$e  = $data['email'];
		$p  = $data['pass'];
		$s  = $data['status'];
		$i  = $data['image'];
	}
	if (($u == $username && $p == $pass) && ($s != "")) 
		{
			session_start();
			$_SESSION['id'] = $id;
			$_SESSION['u'] = $u;
			$_SESSION['n'] = $n;
			$_SESSION['m'] = $m;
			$_SESSION['p'] = $p;
			$_SESSION['e'] = $e;
			$_SESSION['s'] = $s;
			$_SESSION['i'] = $i;
				
			echo "<script>";
			echo "self.location='dashboard.php';";
			echo "</script>";	
		 }
	
	else {
		echo "<script>";
 		echo "self.location='index.php?msg=<font color=red>User Name or Password is incorrect.</font>';";
		echo "</script>";		
	}

?>
