
<?php 
    session_start(); 
    if ($_SESSION['p'] != "") {
    include 'db.php';
?>
<!doctype html>
<html lang="en">
 
<head>
    <?php include 'head.php'; ?>
</head>

<body>

    <?php 
        if ((isset($_POST['submit_next'])) && (isset($_POST['user_ans'])))  {
            $query_ca = mysqli_query($link, "select * from result where id = '$_POST[result_id]' ");
            while($data_ca = mysqli_fetch_array($query_ca)) {
                $correct_ans = $data_ca['correct_ans'];
            }

            if (($_POST['user_ans']==$correct_ans) && ($_POST['user_ans']!='')) {                
                $upd = "UPDATE result SET given_ans='$_POST[user_ans]', question_mark='$_GET[question_mark]', sts='1' WHERE id = '$_POST[result_id]'";
                mysqli_query ($link, $upd);
            } else {
                $upd = "UPDATE result SET given_ans='$_POST[user_ans]', question_mark='0', sts='2' WHERE id = '$_POST[result_id]'";
                mysqli_query ($link, $upd);
            }
        }

    ?>
    
    <div class="dashboard-main-wrapper">
        
        <div class="dashboard-header">
            <?php include 'header.php';  ?>
        </div>
        
        <div class="nav-left-sidebar sidebar-dark">
            <?php include 'left_menu.php'; ?>
        </div>
        
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    
                    
                    <div class="ecommerce-widget">
                        <div class="row">
                            
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body" style="background-color:#DAF7A6;">
                                        <h3>
                                            <?php 
                                                include 'db.php'; 
                                                $query = mysqli_query($link, "select * from exam where id = '$_GET[exam_id]' ");
                                                while($data = mysqli_fetch_array($query)) {
                                                    echo "Exam Name : ".$data['name'];
                                                    $semester_id = $data['semester_id'];
                                                    $subject_id = $data['subject_id'];
                                                    $duration = $data['duration'];
                                                    $question_mark = $data['question_mark'];
                                                    $total_mark = $data['total_mark'];
                                                    $total_question = $data['total_question'];
                                                }

                                            ?>

                                        </h3>

                                        <!-- <?php

                                            $et = $duration;
                                            $et = $et*60;
                                            echo "Time Remining : <span style='border:1px Orange solid; padding:3px;'><span id='display1' style='color:green;'></span></span><br>";
                                            echo "<span id='submitted'></span>";
                                        ?>
                                        <script>
                                            var div = document.getElementById('display1');
                                            var submitted = document.getElementById('submitted');
                                                function CountDown(duration, display) {
                                                      var timer = duration, minutes, seconds;
                                                      var interVal=  setInterval(function () {
                                                            minutes = parseInt(timer / 60, 10);
                                                            seconds = parseInt(timer % 60, 10);
                                                            minutes = minutes < 10 ? "0" + minutes : minutes;
                                                            seconds = seconds < 10 ? "0" + seconds : seconds;
                                                    display.innerHTML = minutes + "m : " + seconds + "s";
                                                            if (timer > 0) {
                                                               --timer;
                                                            }else{
                                                       clearInterval(interVal)
                                                                SubmitFunction();
                                                             }

                                                       },1000);

                                                }

                                              function SubmitFunction(){

                                                submitted.innerHTML="Time is up!";
                                                document.getElementById('mcQuestion').submit();

                                               }
                                               CountDown(<?php echo $et; ?>,div);
                                        </script> -->


                                    </div>

                                    

                                    <div class="card-body" >
                                        <form action="" method="post" name="mcQuestion" id="mcQuestion">
                                            <input type="hidden" name="time_up" value="<?php echo $_GET['unique_code']; ?>">
                                        </form>

                                        <?php 
                                        
                                            $query_chk = mysqli_query($link, "select * from result where unique_code = '$_GET[unique_code]' AND sts = '0' ");
                                            if (mysqli_num_rows($query_chk) < 1) {

                                                $your_mark = 0;
                                                $query_chk2 = mysqli_query($link, "select * from result where unique_code = '$_GET[unique_code]' ");
                                                while($data_chk2 = mysqli_fetch_array($query_chk2)) {
                                                    $your_mark = $your_mark+$data_chk2['question_mark'];
                                                }
                                                $upd = "UPDATE result_summery SET your_mark='$your_mark', sts='1' WHERE unique_code = '$_GET[unique_code]'";
                                                mysqli_query ($link, $upd);

                                                echo "<h6 style='color:Green;'>Your Exam Completed.</h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                echo "<a href='result.php'>View Results</a>";
                                                exit;

                                            }

                                            if ( isset($_POST['time_up']) ) {

                                                $your_mark = 0;
                                                $query_chk2 = mysqli_query($link, "select * from result where unique_code = '$_GET[unique_code]' ");
                                                while($data_chk2 = mysqli_fetch_array($query_chk2)) {
                                                    $your_mark = $your_mark+$data_chk2['question_mark'];
                                                }
                                                $upd = "UPDATE result_summery SET your_mark='$your_mark', sts='1' WHERE unique_code = '$_GET[unique_code]'";
                                                mysqli_query ($link, $upd);

                                                echo "<h6 style='color:Green;'>Your Exam Completed.</h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                echo "<a href='result.php'>View Results</a>";
                                                exit;

                                            }


                                        ?>                                        
                                        

                                        <?php 
                                            $query2 = mysqli_query($link, "select * from result where exam_id = '$_GET[exam_id]' AND unique_code = '$_GET[unique_code]' AND sts = 0 order by sl asc limit 1");
                                            while($data2 = mysqli_fetch_array($query2)) {  

                                                $query3 = mysqli_query($link, "select * from question where id = '$data2[question_id]' ");
                                                while($data3 = mysqli_fetch_array($query3)) {

                                        ?>
                                            <font size="3"><b>
                                                <font color="#FF5733">Question <?= $data2['sl'] ?> of <?php echo $total_question; ?>. </font> <br>
                                                <?= $data3['des'] ?>
                                            </b></font></font></font></font></font><hr>
                                            <form action="#" method="post">
                                                A. <?= $data3['op1'] ?><br><br>
                                                B. <?= $data3['op2'] ?><br><br>
                                                C. <?= $data3['op3'] ?><br><br>
                                                D. <?= $data3['op4'] ?><br><br>                                              
                                                <input type="hidden" name="result_id" value="<?= $data2['id'] ?>">
                                                <select name="user_ans" required>
                                                    <option value="" selected disabled>Ans.</option>
                                                    <option value="a">A</option>
                                                    <option value="b">B</option>
                                                    <option value="c">C</option>
                                                    <option value="d">D</option>
                                                </select>
                                                <br><br>
                                                <input type="submit" name="submit_next" value="&nbsp;&nbsp;&nbsp;Next Question&nbsp;&nbsp;&nbsp;">
                                            </form>
                                        <?php } } ?>

                                        
                                    </div>
                                    

                                </div>
                            </div>
                            


                        </div>                
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    <?php include 'footer_file.php'; ?>
</body>
 
</html>
<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>