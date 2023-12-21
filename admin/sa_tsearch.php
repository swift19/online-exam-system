<?php
include 'db.php';
$searchValue = mysqli_real_escape_string($link, $_POST['searchValue']);
$query = mysqli_query($link, "SELECT * from admin WHERE (name LIKE '%$searchValue%' OR username LIKE '%$searchValue%') ORDER BY id DESC ");

while ($data = mysqli_fetch_array($query)) {
    echo '<tr>';
    echo '<td><input type="checkbox" class="checkBox" style="padding-left: 10px;" value="' . $data['id'] . '"></td>';
    echo '<td>'.$data['tcname'].'</td>';
    echo '<td>'.$data['studentid'].'</td>';
    echo '<td>'.$data['name'].'</td>';
    echo '<td>'.$data['dept'].'</td>';
    echo '<td>'.$data['phoneno'].'</td>';
    echo '<td>'.$data['email'].'</td>';
    echo '<td>'.$data['address'].'</td>';
    echo '</tr>';
}
?>
