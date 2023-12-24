<?php
include './admin/db.php';
$sl = 0;
$searchValue = mysqli_real_escape_string($link, $_POST['searchValue']);
$query = mysqli_query($link, "SELECT *,
    (SELECT name FROM exam WHERE id=a.exam_id) AS Exam,
    (SELECT name FROM subject WHERE id=a.subject_id) AS Subj
FROM `result_summery` AS a
INNER JOIN student AS b ON a.student_id = b.id
HAVING (Exam LIKE '%$searchValue%' OR Subj LIKE '%$searchValue%' 
        OR Subj LIKE '%$searchValue%' OR dept LIKE '%$searchValue%') 
ORDER BY `your_mark` DESC ");

while ($data = mysqli_fetch_array($query)) {
    echo '<tr>';
    echo '<td>'.++$sl.'</td>';
    echo '<td>'.$data['created_at'].'</td>';
    echo '<td>'.$data['name'].'</td>';
    echo '<td>'.$data['dept'].'</td>';
    echo '<td>'.$data['Subj'].'</td>';
    echo '<td>'.$data['Exam'].'</td>';
    echo '<td>'.$data['your_mark'].'</td>';
    echo '</tr>';
}
?>
