<?php
require_once "server/configure.php";
try {
    $sql = "SELECT * FROM REPORTEDUSERS";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    die($e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET["query"])) {
    try {
        $username = $_GET["query"];
        $sql = "SELECT * FROM REPORTEDUSERS WHERE username like ?";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $username);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        die($e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["remove_user"])) {
    try {
        $username = $_POST["remove_user"];
        $sql = "DELETE FROM USER WHERE username = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $username);
        $statement->execute();
        // Refresh the page after deletion
        header("Location: searchUser.php");
        exit();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
?>
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
            <div class="search-container" tabindex="1" style="display:flex">
                <form action="searchUser.php" method="get">
                    <input type="text" placeholder="Search" name="query">
                    <a class="button">
                        <img src="images/search.png" alt="Search">
                    </a>
                </form>
            </div>
            <?php if (isset($result) && !empty($result)): ?>
                <table id="searchUser">
                    <tr>
                        <th>Users</th>
                        <th>Report History</th>
                        <th>Disable User</th>
                    </tr>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td>@<?php echo $row['username']; ?></td>
                            <td><?php echo $row['reportCount']; ?></td>
                            <td>
                                <form action="searchUser.php" method="post">
                                    <input type="hidden" name="remove_user" value="<?php echo $row['username']; ?>">
                                    <button type="submit" class="remove">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>