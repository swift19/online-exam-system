<?php
include 'db.php';

$query = mysqli_query($link, "SELECT * FROM experiment WHERE islock != prev_islock");

while ($data = mysqli_fetch_array($query)) {
    // Update prev_islock to the current islock value
    mysqli_query($link, "UPDATE experiment SET prev_islock = islock WHERE id = $data[id]");
    
    // Use a ternary operator to display 'Unlock' if islock is 0, otherwise 'Lock'
    $status = $data['islock'] == 0 ? 'Unlock' : 'Lock';
    
    echo "$data[name] is now $status";
}
?>
