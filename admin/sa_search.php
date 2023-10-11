<?php
include 'db.php';
$searchValue = mysqli_real_escape_string($link, $_POST['searchValue']);
$sessionId = mysqli_real_escape_string($link, $_POST['sessionId']);
$query = mysqli_query($link, "SELECT DISTINCT *, (select MAX(name) from admin where id=student.designation) as tcname FROM student WHERE status = '1' AND (name LIKE '%$searchValue%' OR dept LIKE '%$searchValue%') ORDER BY id DESC ");
var_dump("test", $query);
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
