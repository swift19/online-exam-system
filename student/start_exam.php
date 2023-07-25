
<?php 
	
	session_start(); 
    include 'db.php';
    
    $unique_code = $_GET['unique_code'];

    $query = mysqli_query($link, "select * from exam where id = '$_GET[exam_id]' ");
    while($data = mysqli_fetch_array($query)) {
    	$semester_id = $data['semester_id'];
    	$subject_id = $data['subject_id'];
    	$duration = $data['duration'];
    	$question_mark = $data['question_mark'];
    	$total_mark = $data['total_mark'];
    }

    // $uc = 0;
    // $query2 = mysqli_query($link, "select * from result where unique_code = '$unique_code' ");
    // while($data2 = mysqli_fetch_array($query2)) {
    // 	$uc = $data2['unique_code'];
    // }

  //   if ($uc == $_GET['unique_code']) {
    	
  //   	echo "<script>";
		// echo "self.location='started_exam.php?exam_id=".$_GET[exam_id]."&unique_code=".$unique_code."';";
		// echo "</script>";

  //   } else {
    	$created_at = date('Y-m-d');
    	$ins = "INSERT INTO result_summery (student_id, exam_id, total_mark, your_mark, sts, unique_code, created_at, semester_id, subject_id) 
    	        VALUES ('$_SESSION[id]', '$_GET[exam_id]', '$total_mark', '0', '0', '$unique_code', '$created_at', '$semester_id', '$subject_id');";
    	mysqli_query ($link, $ins);

    	$sl = 1;
    	$query3 = mysqli_query($link, "select * from question where exam_id = '$_GET[exam_id]' ");
        while($data3 = mysqli_fetch_array($query3)) {
        	$question_id = $data3['id'];
        	$correct_ans = $data3['ans'];

        	$ins = "INSERT INTO result (sl, student_id, exam_id, question_id, correct_ans, given_ans, question_mark, sts, unique_code) 
	    	        VALUES ('$sl', '$_SESSION[id]', '$_GET[exam_id]', '$question_id', '$correct_ans', '0', '0', '0', '$unique_code');";
	    	mysqli_query ($link, $ins);
	    	$sl++;
        }
        $exam_id = $_GET['exam_id'];
        echo "<script>";
		echo "self.location='started_exam.php?exam_id=$exam_id&question_mark=$question_mark&unique_code=$unique_code';";
		echo "</script>";

    //}

                           
?>
