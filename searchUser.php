<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziki Admin</title>
    <style>
        <?php include "css/reset.css"; ?>
    </style>
    <style>
        <?php include "css/admin.css"; ?>
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include "sidebarAdmin.php" ?>
    </div>
    <div class="main">
        <div class="box">
            <table id="searchUser">
                <tr>
                    <th>Users</th>
                    <th>Report History</th>
                    <th>Disable User</th>
                </tr>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>