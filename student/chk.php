<?php
	
	$studentid = $_POST['studentid'];
	$pass = $_POST['password'];
	
	include 'db.php';
	$query = mysqli_query($link, "select * from student where studentid = '$studentid' AND pass = '$pass'");
	while($data = mysqli_fetch_array($query))
	{
		$id    = $data['id'];
		$stdid = $data['studentid'];
		$n     = $data['name'];
		$dept  = $data['dept'];
		$m     = $data['phoneno'];
		$e     = $data['email'];
		$p     = $data['pass'];
		$s     = $data['status'];
	}
	if (($stdid == $studentid && $p == $pass) && ($s != "")) 
		{
			session_start();
			$_SESSION['id']    = $id;
			$_SESSION['stdid'] = $stdid;
			$_SESSION['n']     = $n;
			$_SESSION['dept']  = $dept;
			$_SESSION['m']     = $m;
			$_SESSION['p']     = $p;
			$_SESSION['e']     = $e;
			$_SESSION['s']     = $s;			
				
			echo "<script>";
			echo "self.location='dashboard2.php';";
			echo "</script>";	
		 }
	
	else {
		echo "<script>";
 		echo "self.location='index2.php?msg=<font color=red>Email or Password is incorrect.</font>';";
		echo "</script>";		
	}

?>
