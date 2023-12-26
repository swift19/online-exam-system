<?php
include 'db.php';
$query = mysqli_query($link, "select * from experiment where (name LIKE '%Frog%') ");

while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id'];
    $isrubric = $row['isrubric'];
    // var_dump("aa" , $row);
    if ($isrubric) {
        var_dump("aa") ;
        $ins = "UPDATE experiment SET isrubric ='0' where id='$id'";
    } else {
        $ins = "UPDATE experiment SET isrubric ='1' where id='$id'";
        var_dump("bb" );
    }
    mysqli_query($link, $ins);  // Added semicolon here
}
?>
