<?php
	$link = mysqli_connect ("localhost", "root", "");
    mysqli_select_db ($link, "onlineexam");
    $link->set_charset("utf8");        
?>