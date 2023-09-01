<?php
include 'db.php';
if(isset($_POST['studentId']) && isset($_POST['sessionId']))  {
    $studentId = $_POST['studentId'];
    $sessionId = $_POST['sessionId'];
    
    $updateQuery = "UPDATE student SET designation = '$sessionId' WHERE id = '$studentId'";
    
    if(mysqli_query($link, $updateQuery)) {
        echo "Designation updated successfully.";
    } else {
        echo "Error updating designation: " . mysqli_error($link);
    }
} else {
    echo "Invalid student ID.";
}

?>
