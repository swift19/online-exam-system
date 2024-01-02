<?php
	$link = mysqli_connect ("localhost", "root", "");
    mysqli_select_db ($link, "onlineexam");
    $link->set_charset("utf8");      
    date_default_timezone_set('Asia/Manila');  
?>