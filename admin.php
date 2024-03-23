<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziki Admin</title>
    <style>
        <?php include "css/reset.css";
        include "css/admin.css"
            ?>
    </style>
</head>

<body>


    <header class="header">
        <?php include "pageheader.php" ?>

    </header>

    <nav id="nav-bar">

        <p class="current-selection"> <a href=""> Dashboard</a></p>
        <p> <a href=""> Users </a> </p>
        <p><a href="">Post Management </a> </p>

    </nav>

    <div class="main">
        <h2> Overview</h2>
        <div class="overview-box">
            <div class="title-box">
                <h3>User Registration Stats</h3>
            </div>

        </div>
        <div class="overview-box">
            <div class="title-box">
                <h3> Total Users</h3>
            </div>

        </div>
        <div class="overview-box">

            <div class="title-box">
                <h3>
                    Total Posts
                </h3>
            </div>


        </div>

    </div>
</body>

</html>