
<?php 
	session_start(); 
    include 'db.php';
    
    $unique_code = $_GET['unique_code'];

    $query = mysqli_query($link, "select * from experiment where id = '$_GET[experiment_id]' ");
   
    	$created_at = date('Y-m-d');
    	$ins = "INSERT INTO result_summery_experiment (student_id, experiment_id, total_mark, your_mark, sts, unique_code, created_at) 
    	        VALUES ('$_SESSION[id]', '$_GET[experiment_id]', '0', '0', '0', '$unique_code', '$created_at');";
    	mysqli_query ($link, $ins);

    	$sl = 1;
    	$query3 = mysqli_query($link, "select * from question_experiment where experiment_id = '$_GET[experiment_id]' ");
        while($data3 = mysqli_fetch_array($query3)) {
        	$question_id = $data3['id'];
        	$correct_ans = $data3['ans'];

        	$ins = "INSERT INTO result_experiment (sl, student_id, experiment_id, question_id, correct_ans, given_ans, question_mark, sts, unique_code) 
	    	        VALUES ('$sl', '$_SESSION[id]', '$_GET[experiment_id]', '$question_id', '$correct_ans', '0', '1', '0', '$unique_code');";
	    	mysqli_query ($link, $ins);
	    	$sl++;
        }
        $experiment_id = $_GET['experiment_id'];
        echo "<script>";
		echo "self.location='started_quiz_ex.php?experiment_id=$experiment_id&unique_code=$unique_code';";
		echo "</script>";                   
?>
