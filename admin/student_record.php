<?php 
    session_start(); 
    if ($_SESSION['p'] != "") {
?>
<!doctype html>
<html lang="en">
 
<head>
    <?php include 'head.php'; ?>
</head>

<body>
    
    <div class="dashboard-main-wrapper">
        
         <div class="dashboard-header">
            <?php include 'header.php';  ?>
        </div>
        
       <div class="nav-left-sidebar sidebar-dark">
            <?php include 'left_menu.php'; ?>
        </div>
        
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                
                <div class="row">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            
                            <h5 class="card-header">Historical Record</h5>
                           
                            <div class="card-body">
                                <figure class="highcharts-figure">
                                    <p class="highcharts-description">
                                    A spline chart is a type of graph used to display smooth, curved data. It is created by 
                                    connecting a series of control points with lines that are chosen to minimise the bending 
                                    or curvature of the graph. Spline charts can be used to show trends, changes, and relationships 
                                    in data in a smooth and visual way.
                                    </p>
                                    <div id="container"></div>
                                    <div id="container-experiment"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
    
    <!-- High charts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
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
    
    <?php
        include 'db.php';
        // Fetch data from MySQL query
        $id = isset($_GET['id']) ? $_GET['id'] : 0; // Assuming 'id' is the parameter you want to use

        $query = mysqli_query($link, "SELECT a.created_at, a.your_mark,b.name FROM result_summery as a 
                                      inner join exam as b on b.id=a.exam_id WHERE a.student_id =$id");
        // Prepare the data array
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = [$row['created_at'], (float)$row['your_mark'], $row['name']];
        }

        // Convert data array to JSON
        $dataJson = json_encode($data);

        // Experiment
        $query = mysqli_query($link, "SELECT a.created_at, a.your_mark,b.name FROM result_summery_experiment as a 
        inner join experiment as b on b.id=a.experiment_id WHERE a.student_id =$id");
        // Prepare the data array
        $dataExp = [];
        while ($row = mysqli_fetch_assoc($query)) {
        $dataExp[] = [$row['created_at'], (float)$row['your_mark'], $row['name']];
        }

        // Convert data array to JSON
        $dataExpJson = json_encode($dataExp);
    ?>


<script>
const data = <?php echo $dataJson; ?>;
const dataExp = <?php echo $dataExpJson; ?>;
const colors = Highcharts.getOptions().colors;
const uniqueNames = [...new Set(data.map(item => item[2]))];
const uniqueNamesExp = [...new Set(dataExp.map(item => item[2]))];
const seriesConfigurations = [];
const seriesConfigurationsExp = [];

uniqueNames.forEach((name, index) => {
    seriesConfigurations.push({
        name: name,
        data: data
            .filter(item => item[2] === name)
            .map(item => [item[0], item[1]]),
        color: colors[index % colors.length], // Use colors in a loop
        dashStyle: 'ShortDashDot',
    });
});

uniqueNamesExp.forEach((name, index) => {
    seriesConfigurationsExp.push({
        name: name,
        data: dataExp
            .filter(item => item[2] === name)
            .map(item => [item[0], item[1]]),
        color: colors[index % colors.length], // Use colors in a loop
        dashStyle: 'ShortDashDot',
    });
});

Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },

    legend: {
        symbolWidth: 40
    },

    title: {
        text: 'Examination Record',
        align: 'left'
    },

    // subtitle: {
    //     text: 'Note: You can download the graph in the hamburger menu icon',
    //     align: 'left'
    // },

    yAxis: {
        title: {
            text: 'Score'
        },
        accessibility: {
            description: 'Score'
        }
    },

    xAxis: {
        title: {
            text: 'Timeline'
        },
        accessibility: {
            description: 'Timeline'
        },
        categories: <?php echo json_encode(array_column($data, 0)); ?>,
    },

    tooltip: {
        valueSuffix: ' score',
        stickOnContact: true
    },

    plotOptions: {
        series: {
            point: {
                events: {
                    click: function () { 
                        // redirect to other page
                        // window.location.href = this.series.options.website;
                    }
                }
            },
            cursor: 'pointer',
            lineWidth: 2
        }
    },
    series: seriesConfigurations,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 550
            },
            chartOptions: {
                chart: {
                    spacingLeft: 3,
                    spacingRight: 3
                },
                legend: {
                    itemWidth: 150
                },
                xAxis: {
                    categories: <?php echo json_encode(array_column($data, 0)); ?>,
                    title: ''
                },
                yAxis: {
                    visible: false
                }
            }
        }]
    }
});


Highcharts.chart('container-experiment', {
    chart: {
        type: 'spline'
    },

    legend: {
        symbolWidth: 40
    },

    title: {
        text: 'Experiment Record',
        align: 'left'
    },

    // subtitle: {
    //     text: 'Note: You can download the graph in the hamburger menu icon',
    //     align: 'left'
    // },

    yAxis: {
        title: {
            text: 'Score'
        },
        accessibility: {
            description: 'Score'
        }
    },

    xAxis: {
        title: {
            text: 'Timeline'
        },
        accessibility: {
            description: 'Timeline'
        },
        categories: <?php echo json_encode(array_column($dataExp, 0)); ?>,
    },

    tooltip: {
        valueSuffix: ' score',
        stickOnContact: true
    },

    plotOptions: {
        series: {
            point: {
                events: {
                    click: function () { 
                        // redirect to other page
                        // window.location.href = this.series.options.website;
                    }
                }
            },
            cursor: 'pointer',
            lineWidth: 2
        }
    },
    series: seriesConfigurationsExp,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 550
            },
            chartOptions: {
                chart: {
                    spacingLeft: 3,
                    spacingRight: 3
                },
                legend: {
                    itemWidth: 150
                },
                xAxis: {
                    categories: <?php echo json_encode(array_column($dataExp, 0)); ?>,
                    title: ''
                },
                yAxis: {
                    visible: false
                }
            }
        }]
    }
});
</script>

</body>
 
</html>

<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>