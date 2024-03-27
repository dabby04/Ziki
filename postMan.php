<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "admin") {
    header("Location: login.php");
    exit;
}?>
<?php
$list = array();
$jsArray = json_encode($list);
try {
    require_once "server/configure.php";
    $sql = "SELECT POSTS.title, USER.username, REPORTED.count FROM REPORTED JOIN POSTS ON REPORTED.postId=POSTS.id JOIN USER ON REPORTED.userId=USER.id ORDER BY REPORTED.count DESC";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
        $jsArray = json_encode($list);
    } else {
        $message = "No posts found";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

} catch (PDOException $e) {
    die($e->getMessage());
}
?>
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
        <?php
        
        include "pageheader.php";
        include "css/admin.css";
        ?>
    </style>
    <script src="script/admin.js"></script>
    <script>
    var topics = <?php echo $jsArray; ?>;
    window.onload = function () {
        const displayReported = document.getElementsByClassName("reported")[0];
        displayReported.innerHTML = topics.map((e) => {
            return `
            <fieldset>
                <legend>@${e.username}</legend>
                <p>${e.title}</p>
                <button class="remove">Remove</button>
            </fieldset>`;
        }).join("");
    }
</script>

</head>

<body>
    <div class="wrapper">
        <?php include "sidebarAdmin.php" ?>
    </div>

    <div class="main">
        <div class="box">
            <h3>Reported Posts</h3>
            <div class="reported">

            </div>





        </div>
</body>

</html>