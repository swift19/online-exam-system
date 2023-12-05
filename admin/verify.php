<?php
session_start(); 
include 'db.php';

if($_GET['secret'])
{
 
  $email = base64_decode($_GET['secret']);
  $verify = mysqli_query($link,"update admin set status='2' where email='$email'");
  if($verify > 0)
  {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=green>Your account is activated!</font>';";
    echo "</script>";
  }
  else
  {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Error while activating your account!</font>';";
    echo "</script>";
  }
}
?>

