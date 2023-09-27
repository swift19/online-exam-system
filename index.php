<!DOCTYPE html>
<?php 
    session_start();       
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stemulate</title>
  <link rel="stylesheet" href="student/assets/libs/css/main.css">
</head>
<body>
  <div class="login-container">
	<div class="logos-xs-container">
		<img src="student/assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate">
	</div>

    <div class="logos-container">
      <div class="logo-fixed">
        <img src="student/assets/images/logo-stemulate.png" width=250 height=100 alt="logo-stemulate">
      </div>
      
      <img src="student/assets/images/stemulate-home.png" width=80 height=250 alt="stemulate-home" class="img-testube">
    </div>
    <div class="landing-form">
      <p class="welcome-header">Welcome!</p>
      
      <p class="sub-content content">Who are you?</p>

	  <div class="row">
      <a href="admin/">
        <img src="student/assets/images/frame-admin.png" alt="stemulate-home">
      </a>
      <a href="student/">
        <img src="student/assets/images/frame-student.png" alt="stemulate-home">
      </a>
	  </div>
    <br/>
	  <div class="top20">
      <img id="top20Image" src="student/assets/images/top20-award.png" width=80 height=80 alt="stemulate-home">
    </div>
    </div>
  </div>


      <!-- Modal -->
    <div id="leaderboardModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <div class="table-responsive"  style="height: 300px; overflow-y: auto;">
                                      <table class="table table-striped table-bordered"><thead>
                                            <tr>
                                              <th>Top 20 Student</th>
                                            </tr>
                                            <tr>
                                                <th>Ranking</th>
                                                <th>Date</th>
                                                <th>Student Name</th>
                                                <!-- <th>Semester</th> -->
                                                <th>Subject</th>
                                                <th>Exam Name</th>
                                                <!-- <th>Total Mark</th> -->
                                                <th>Your Score</th>
                                                <!-- <th>Merit Position</th>
                                                <th>Highest Score</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sl = 0;
                                                include 'student/db.php'; 
                                                $query = mysqli_query($link, "SELECT *, MAX(your_mark) as highest_score from result_summery where  sts = '1'  GROUP BY student_id order by id DESC LIMIT 20 ");
                                                while($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$sl; ?></td>
                                                <td><?php echo $data['created_at']; ?></td>
                                                <td>
                                                    <?php 
                                                        $query2 = mysqli_query($link, "select * from student where id = '$data[student_id]'");
                                                        while($data2 = mysqli_fetch_array($query2)) {
                                                            echo $data2['name']; 
                                                        }
                                                    ?>
                                                </td>
                                                <!-- <td>
                                                    <?php 
                                                        $query2 = mysqli_query($link, "select * from semester where id = '$data[semester_id]'");
                                                        while($data2 = mysqli_fetch_array($query2)) {
                                                            echo $data2['name']; 
                                                        }
                                                    ?>
                                                </td> -->
                                                <td>
                                                    <?php 
                                                        $query2 = mysqli_query($link, "select * from subject where id = '$data[subject_id]'");
                                                            while($data2 = mysqli_fetch_array($query2)) {
                                                            echo $data2['name']; 
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $query2 = mysqli_query($link, "select * from exam where id = '$data[exam_id]'");
                                                        while($data2 = mysqli_fetch_array($query2)) {
                                                            echo $data2['name']; 
                                                        }
                                                    ?>
                                                </td>
                                                <!-- <td><?php echo $data['total_mark']; ?></td> -->
                                                <td><?php echo $data['your_mark']; ?></td>
                                                
                                                <!-- <td>

                                                    <?php 
                                                        $mp = 1;
                                                        $query3 = mysqli_query($link, "select * from result_summery where exam_id = '$data[exam_id]' and sts = '1' order by your_mark desc ");
                                                        while($data3 = mysqli_fetch_array($query3)) {
                                                            $position = $mp++;
                                                            if ($data['unique_code']==$data3['unique_code']){
                                                                $my_position = $position;
                                                            }
                                                        }
                                                        echo $my_position;

                                                    ?>

                                                </td>
                                                <td><?php echo $data['highest_score']; ?></td> -->
                                            </tr> 
                                            <?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
        </div>
      </div>
    </div>
    <link rel="stylesheet" href="admin/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/vendor/fonts/circular-std/style.css">
    <link rel="stylesheet" href="admin/assets/libs/css/style.css">
    <link rel="stylesheet" href="admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="admin/assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="admin/assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="admin/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="admin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">

    <script>
      // Get the modal and close button elements
      var modal = document.getElementById("leaderboardModal");
      var closeBtn = document.getElementsByClassName("close")[0];

      // When the top20 element is clicked, show the modal
      document.querySelector(".top20").addEventListener("click", function () {
        modal.style.display = "block";
      });

      // When the close button is clicked, hide the modal
      closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
      });

      // Close the modal if the user clicks outside of it
      window.addEventListener("click", function (event) {
        if (event.target === modal) {
          modal.style.display = "none";
        }
      });

    </script>

</body>
</html>
