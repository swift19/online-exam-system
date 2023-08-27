<?php
include 'db.php';
$subjectId = $_GET['subject_id'];
$query = mysqli_query($link, "select * from experiment where subject_id = '$subjectId' and status = '1'");
$experiments = array();
while ($data = mysqli_fetch_assoc($query)) {
    $experiments[] = $data;
}
echo json_encode($experiments);
?>
