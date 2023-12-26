<?php
// Get the data from the request
$newTag = $_POST['newTag'];

// Read the existing sections from the JSON file
$sectionsJson = file_get_contents('sections.json');
$sections = json_decode($sectionsJson, true);

// Check if the new tag is not empty
if (trim($newTag) !== '') {
    // Update sections with the new tag
    $sections[] = array('value' => $newTag, 'label' => $newTag);

    // Write the updated sections back to the JSON file
    file_put_contents('sections.json', json_encode($sections));
}
?>
