<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "admin") {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziki Admin</title>
    <style>
        <?php include "css/reset.css";
        include "css/admin.css";
        include "pageheader.php";
        ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php include "sidebarAdmin.php" ?>
    </div>
    <div class="main">
        <div class="overview-box">
            <div class="title-box">
                <h3>User Registration Stats</h3>
                <iframe id="plotFrame" src="plot.html" title="description"></iframe>
            </div>
        </div>
        <div class="overview-box">
            <div class="title-box">
                <h3>Total Users</h3>
                <h3 id="results">
                    <?php echo $users ?>
                </h3>
            </div>
        </div>
        <div class="overview-box">
            <div class="title-box">
                <h3>Total Posts</h3>
                <h3 id="results_p">
                    <?php echo $posts ?>
                </h3>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.logo').mouseenter(function () {
                $('.main').css('marginLeft', '300px');
            });

            $('.logo').mouseleave(function () {
                $('.main').css('marginLeft', '100px');
            });

            // Make AJAX request to fetch data
            function fetchData() {
                $.ajax({
                    url: 'ajax/adminAjax.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        updateUI(data);
                    },
                    error: function (xhr, status, error) {
                        console.error('Request failed: ' + error);
                    }
                });
            }

            // Update UI with fetched data
            function updateUI(data) {
                $('#results').html(data.totalUser);
                $('#results_p').html(data.totalPost);
                $('#plotFrame').attr('src', $('#plotFrame').attr('src'));
            }

            // Fetch data initially and set interval to update periodically
            fetchData();
            setInterval(fetchData, 60000); // Update every minute (adjust as needed)
        });
    </script>
</body>
</html>
