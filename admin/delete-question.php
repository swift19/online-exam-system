<?php
include 'db.php';
if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];
    $dlt = "DELETE FROM $table WHERE id = '$id'";
    mysqli_query($link, $dlt);
}
?>
