<?php

if (isset($_GET['experimentType']) && isset($_GET['experiment'])) {
    $experimentType = $_GET['experimentType'];
    $experiment = $_GET['experiment'];

    include 'db.php';
    $query = mysqli_query($link, "SELECT url,custom,id FROM experiment WHERE subject_id = '$experimentType' AND id = '$experiment' AND status = '1'");
    $data = mysqli_fetch_assoc($query);
    $iframeContent = $data['url'];
    $custom = $data['custom'];
    $exId = $data['id'];
    // Store the URL in a session variable
    session_start();
    if($iframeContent || $custom || $exId){
        $_SESSION['url'] = $iframeContent;
        $_SESSION['custom'] = $custom;
        $_SESSION['exId'] = $exId;
    }

    echo $iframeContent;
}
?>
