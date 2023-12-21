<?php
include 'db.php';

if (isset($_POST['pdfId']) && isset($_POST['studentId']) && isset($_POST['adminId'])) {
    $pdfId = $_POST['pdfId'];
    $studentId = $_POST['studentId'];
    $adminId = $_POST['adminId'];

    // Check if the record already exists
    $checkQuery = "SELECT COUNT(*) as count FROM pdf_status 
                   WHERE student_id = '$studentId' 
                   AND admin_id = '$adminId' 
                   AND pdf_id = '$pdfId'";
    
    $result = mysqli_query($link, $checkQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $existingCount = $row['count'];

        if ($existingCount == 0) {
            // The record doesn't exist, proceed with the insertion
            $updateQuery = "INSERT INTO pdf_status (student_id, admin_id, is_read, pdf_id) 
                            VALUES ('$studentId', '$adminId', '1', '$pdfId');";
            
            if (mysqli_query($link, $updateQuery)) {
                echo "PDF Status updated.";
            } else {
                echo "Error updating pdf status: " . mysqli_error($link);
            }
        } else {
            // The record already exists, do nothing
            echo "Record already exists.";
        }
    } else {
        echo "Error checking existing record: " . mysqli_error($link);
    }
} else {
    echo "Invalid session. Please try again";
}
?>
