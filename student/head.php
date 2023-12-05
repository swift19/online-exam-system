<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/fonts/circular-std/style.css">
    <link rel="stylesheet" href="assets/libs/css/main.css">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Student Dashboard</title>

    <script>
        $(document).ready(function () {
            // Function to check for updates
            function checkForUpdates() {
                // AJAX request to fetch notification status
                $.ajax({
                    url: 'check_notification.php', // Replace with the actual PHP file to check notifications
                    type: 'GET',
                    success: function (data) {
                        // Display notification if there are updates
                        if (data.trim() !== "") {
                            showNotification(data);
                        }
                    },
                    complete: function () {
                        // Schedule the next check after a delay (e.g., every 10 seconds)
                        setTimeout(checkForUpdates, 10000);
                    }
                });
            }

            // Function to display notification
            function showNotification(message) {
                // Replace this with your notification logic (e.g., display a bell icon)
                alert('Notification: ' + message);
            }

            // Start checking for updates when the page is loaded
            checkForUpdates();
        });
    </script>