<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziki Admin</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/sidebarAdmin.css" />
    <link rel="stylesheet" href="css/admin.css" />
    <script src="script/admin.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php include "sidebarAdmin.php" ?>
    </div>

    <div class="main">
        <div id="search-box"> <input type="search" placeholder="search for a user post or word">
        </div>

        <table border="1">
            <thead>
                <tr>
                    <th>Incomplete Post</th>
                    <th>Reported Posts</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Post 1</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>Row 2, Col 1</td>
                    <td>Row 2, Col 2</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Row 4, Col 1</td>
                    <td>Row 4, Col 2</td>
                </tr>
            </tbody>
        </table>



    </div>
</body>

</html>