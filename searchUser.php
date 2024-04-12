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
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <div class="wrapper">
        <?php include "sidebarAdmin.php" ?>
    </div>
    <div class="main">
        <div class="box">
            <div class="search-container2" tabindex="1" style="display:flex">
                <form id="searchForm" action="searchUser.php" method="get">
                    <input type="text" id="searchInput" placeholder="Search" name="query">
                    <a class="button" onclick="searchUsers()">
                        <img src="images/search.png" alt="Search">
                    </a>
                </form>
            </div>
            <table id="searchUser">
                <thead>
                    <tr>
                        <th>Users</th>
                        <th>Report History</th>
                        <th>Disable User</th>
                    </tr>
                </thead>
                <tbody id="userList"></tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to get reported users
        function getReportedUsers() {
            $.ajax({
                url: "ajax/searchUserAjax.php",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response && response.length > 0) {
                        var html = "";
                        $.each(response, function (index, user) {
                            html += "<tr>";
                            html += "<td>" + user.username + "</td>";
                            html += "<td>" + user.reportCount + "</td>";
                            html += "<td><button class='remove' onclick='removeUser(\"" + user.username + "\")'>Remove</button></td>";
                            html += "</tr>";
                        });
                        $("#userList").html(html);
                    } else {
                        $("#userList").html("<tr><td colspan='3'>No results found.</td></tr>");
                    }
                }
            });
        }

        // Call getReportedUsers when the page loads
        $(document).ready(function () {
            getReportedUsers();
            // Set interval to refresh reported posts every 30 seconds (adjust as needed)
            setInterval(getReportedUsers, 30000); // 30 seconds

            $("#searchInput").keypress(function (event) {
                // Check if the Enter key is pressed
                if (event.which == 13) {
                    // Call searchUsers() function when Enter key is pressed
                    searchUsers();
                    // Prevent default form submission
                    event.preventDefault();
                }
            });
        });


        function searchUsers() {
            var query = $("#searchInput").val();
            console.log(query);
            $.ajax({
                url: "ajax/searchUserAjax.php",
                type: "GET",
                data: { query: query },
                dataType: "json",
                success: function (response) {
                    if (response && response.length > 0) {
                        var html = "";
                        $.each(response, function (index, user) {
                            html += "<tr>";
                            html += "<td>" + user.username + "</td>";
                            html += "<td>" + user.reportCount + "</td>";
                            html += "<td><button class='remove' onclick='removeUser(\"" + user.username + "\")'>Remove</button></td>";
                            html += "</tr>";
                        });
                        $("#userList").html(html);
                    } else {
                        $("#userList").html("<tr><td colspan='3'>No results found.</td></tr>");
                    }
                }
            });
            // Prevent default form submission
            // return false;
        }

        function removeUser(username) {
            if (confirm("Are you sure you want to remove this user?")) {
                $.ajax({
                    url: "ajax/searchUserAjax.php",
                    type: "POST",
                    data: { remove_user: username },
                    dataType: "json",
                    success: function (response) {
                        if (response && response.success) {
                            alert("User removed successfully.");
                            // Refresh user list after deletion
                            getReportedUsers();
                        } else {
                            alert("Failed to remove user.");
                        }
                    }
                });
            }
        }
    </script>
</body>

</html>