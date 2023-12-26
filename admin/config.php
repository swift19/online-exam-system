<?php 
    session_start(); 
    if ($_SESSION['u']==='superadmin') {
?>
<!doctype html>
<html lang="en">
 
<head>
    <?php include 'head.php'; ?>
</head>

<body>
    
    <div class="dashboard-main-wrapper">
        
         <div class="dashboard-header">
            <?php include 'header.php';  ?>
        </div>
        
       <div class="nav-left-sidebar sidebar-dark">
            <?php include 'left_menu.php'; ?>
        </div>

       
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            
                            <h5 class="card-header">Configuration</h5>
                                
                            <div class="card-body">

                            <form action="#" method="post" onsubmit="return false;">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <?php 
                                                include 'db.php';   
                                                $query = mysqli_query($link, "SELECT * FROM experiment WHERE name LIKE '%Frog%'");
                                                while ($data = mysqli_fetch_assoc($query)) {
                                            ?>
                                <div class="toggle-container">
                                    <label id="toggleText">Turn on Rubric for Frog Simulation?   </label>
                                    <label class="switch">
                                        <input type="checkbox" id="toggleSwitch" <?php echo $data['isrubric'] ? 'checked' : ''; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <?php } ?>
                                <br><br>
                                <div class="form-group">
                                    <label>Sections</label>
                                    <input type="text" id="tagInput" class="form-control form-control-lg" placeholder="Type Section and press Enter">
                                </div>
                                <div id="tagContainer"></div>
                            </div>

                            </form>
                                <!-- <button type="submit" name="save" class="btn btn-primary btn-lg btn-block">Save</button> -->
                            </div>
                        </div>
                    </div>                    
                </div>
                
            </div>
            
        </div>
    </div>


    <script>
    // Get the state of the toggle switch
    document.getElementById("toggleSwitch").addEventListener("change", function() {
        
        // Make an AJAX request to fetch experiments based on selected subject
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "update_rubric.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
               console.log("ggg", JSON.parse(xhr.responseText))
            }
        };
        xhr.send();
    });

    const tagContainer = document.getElementById('tagContainer');
    const tagInput = document.getElementById('tagInput');

    // Fetch sections from sections.json
    fetch('sections.json')
    .then(response => response.json())  // Explicitly parse the response as JSON
    .then(sections => {
        // Ensure sections is an array before filtering
        const sectionsArray = Array.isArray(sections) ? sections : [];
      
        // Filter out empty values
        const filteredSections = sectionsArray.filter(section => section.value !== '');
        console.log("filteredSections" , filteredSections)
        // Populate initial tags
        filteredSections.forEach(section => addTag(section.value));
    });


    tagInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && tagInput.value.trim() !== '') {
            addTag(tagInput.value.trim());
             // Update sections.json with the new tag
             updateSectionsJson(tagInput.value.trim());
            tagInput.value = '';
        }
    });

    function addTag(tagText) {
        const tagElement = document.createElement('div');
        tagElement.className = 'tag';
        tagElement.textContent = tagText;
        tagElement.addEventListener('click', function () {
            makeTagEditable(tagElement);
        });
        tagContainer.appendChild(tagElement);
    }

    function makeTagEditable(tagElement) {
        const tagText = tagElement.textContent;
        const inputElement = document.createElement('input');
        inputElement.type = 'text';
        inputElement.value = tagText;
        inputElement.className = 'editable';

        function handleBlur() {
            const newText = inputElement.value.trim();
            if (newText !== tagText && newText !== '') {
                updateTag(tagElement, newText);

                // Update sections.json with the modified tag
                updateSectionsJson(newText);
            }
            inputElement.replaceWith(tagElement);
        }

        // Attach blur event listener
        inputElement.addEventListener('blur', handleBlur);

        // Replace tag with input
        tagElement.replaceWith(inputElement);

        inputElement.focus();
    }

    function updateTag(tagElement, newText) {
        tagElement.textContent = newText;
        tagElement.addEventListener('click', function () {
            makeTagEditable(tagElement);
        });
    }
    function updateSectionsJson(newTag) {
    console.log("push", newTag);

    // Send a POST request to save_sections.php
    fetch('save_sections.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'newTag=' + encodeURIComponent(newTag),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        if (data.trim() !== '') {
        const jsonData = JSON.parse(data);
        console.log('Success:', jsonData);
        } else {
        console.log('Response is empty');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


    // Add event listener to tagContainer to handle click events
    tagContainer.addEventListener('click', function (event) {
        const clickedElement = event.target;
        if (clickedElement.classList.contains('tag')) {
            makeTagEditable(clickedElement);
        }
    });
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}
?>




    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
   
</body>
 
</html>

<?php 
} else {
    echo "<script>";
    echo "self.location='index.php?msg=<font color=red>Please Login First.</font>';";
    echo "</script>";
}
?>