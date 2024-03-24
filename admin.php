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
    <?php
    $users;
    $posts;
    try {
        require_once "server/configure.php";

        $sql = "SELECT COUNT(username) as totalUser FROM USER";
        $statement = $pdo->prepare($sql);
        $statement->execute();

        // Fetch the count of users
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $totalUser = $row["totalUser"];

        // If there are users, redirect to the home page or another appropriate page
        if ($totalUser > 0) {
            $users=$totalUser;
        } else {
            // No users found
            $users=0;
        }

        $sql="SELECT COUNT(title) as totalPost FROM POSTS";
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $totalPosts = $row["totalPost"];

        if ($totalPosts > 0) {
            $posts=$totalPosts;
        } else {
            $posts= 0;
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        // Log the error or display a user-friendly message
        echo "Database Error: " . $e->getMessage();
    }
    ?>

    <script src="script/admin.js"></script>
    <div class="wrapper">
        <?php include "sidebarAdmin.php" ?>
    </div>
    <div class="main">
        <div class="overview-box">
            <div class="title-box">
                <h3>User Registration Stats</h3>
            </div>

        </div>
        <div class="overview-box">
            <div class="title-box">
                <h3> Total Users</h3>
                <h3 id="results"><?php echo $users?></h3>
            </div>

        </div>
        <div class="overview-box">

            <div class="title-box">
                <h3>
                    Total Posts
                </h3>
                <h3 id="results"><?php echo $posts?></h3>
            </div>


        </div>

    </div>
</body>

</html>