<?php 
    session_start(); 
    if ($_SESSION['p'] != "") {
        
?>
<!doctype html>
<html lang="en">
 
<head>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <style>
        #container {
            height: 400px; /* Adjust the height as needed */
            width: 400px;  /* Adjust the width as needed */
            overflow: hidden; /* Hide the bottom part of the circle */
            clip-path: polygon(0 0, 100% 0, 100% 65%, 0 65%); /* Clip the container to show only the top 65% */
            align-self: center;
        }
        @media (max-width: 767px) {
            #container {
                width: 80%; /* Make it full-width for small screens */
            }
        }
    </style>
    <?php include 'head.php'; ?>
</head>

<body>
    
    <div class="dashboard-main-wrapper">
        
         <div class="dashboard-header">
            <?php include 'header.php';  ?>
            <?php include 'navigation.php';  ?>
        </div>
        
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                
                <div class="row">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            
                            <h5 class="card-header">Result List </h5>
                            <span style="padding-left:20px; padding-top:10px;">
                                <?php 
                                    if (isset($_GET['msg'])) {
                                        echo $_GET['msg'];
                                    }
                                ?>
                                
                            </span>
                            
                            <div id="container" style="height: 400px;"></div>
                            
                            <div class="card-body" style="margin-top: -100px;">
                            <h4><b>Computation:</b> (sum(your score)/sum(total question)) * 100% = Average rating</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Semester</th>
                                                <th>Subject</th>
                                                <th>Exam Name</th>
                                                <th>Your Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sl = 0;
                                                include 'db.php'; 
                                                $query = mysqli_query($link, "select * from result_summery where student_id = '$_SESSION[id]' and sts = '1' order by id desc ");
                                                while($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$sl; ?></td>
                                                <td><?php echo $data['created_at']; ?></td>
                                                
                                                <td>
                                                    <?php 
                                                        $query2 = mysqli_query($link, "select * from semester where id = '$data[semester_id]'");
                                                        while($data2 = mysqli_fetch_array($query2)) {
                                                            echo $data2['name']; 
                                                        }
                                                    ?>
                                                </td>
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
                                                <td><?php echo $data['your_mark']; ?></td>
                                            </tr> 
                                            <?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
    <?php
    include 'db.php'; 
    $score = mysqli_query($link, "SELECT DISTINCT b.name, b.total_question, a.your_mark FROM `result_summery` as a INNER JOIN exam as b
    ON a.exam_id = b.id WHERE a.student_id = '$_SESSION[id]' AND sts = '1'");
    
    $data = [];
    
    while ($row = mysqli_fetch_assoc($score)) {
        $data[] = [$row['name'], $row['total_question'], $row['your_mark']];
    }

    // Convert data array and distinct names array to JSON
    $dataJson = json_encode($data);
?>
<script>
    const data = <?php echo $dataJson; ?>;

    // Initialize sum variables
    let sumData1 = 0;
    let sumData2 = 0;

    // Loop through the data array to calculate the sum
    data.forEach(item => {
        sumData1 += parseInt(item[1], 10); // Convert string to integer and add to sumData1
        sumData2 += parseInt(item[2], 10); // Convert string to integer and add to sumData2
    });

    console.log("Sum of total_question:", sumData1);
    console.log("Sum of your_mark:", sumData2);
    // Calculate average percentage
    const averageRating = (sumData2 / sumData1) * 100;

    console.log("Average Percentage: ", averageRating);

    Highcharts.chart('container', {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Average Score Rating Meter'
        },
        pane: {
            startAngle: -90, // Adjusted to create a half gauge
            endAngle: 90,   // Adjusted to create a half gauge
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        // the value axis
        yAxis: {
            min: 0,
            max: 100,
            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',
            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Rating'
            },
            plotBands: [{
                from: 0,
                to: 20,
                color: '#FF6347', // Red for Bad
                innerRadius: '100%',
                outerRadius: '105%'
            }, {
                from: 20,
                to: 40,
                color: '#FFD700', // Gold for Good
                innerRadius: '100%',
                outerRadius: '105%'
            }, {
                from: 40,
                to: 60,
                color: '#32CD32', // Green for Better
                innerRadius: '100%',
                outerRadius: '105%'
            }, {
                from: 60,
                to: 100,
                color: '#4682B4', // SteelBlue for Excellent
                innerRadius: '100%',
                outerRadius: '105%'
            }]
        },
        series: [{
            name: 'Rating',
            data: [averageRating], // Set the average rating value here
            tooltip: {
                valueSuffix: ''
            }
        }]
    });
</script>

    
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    
</body>
 
</html>

<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>