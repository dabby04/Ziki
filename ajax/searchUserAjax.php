<?php
require_once "../server/configure.php";

// Function to get reported users
function getReportedUsers($pdo, $username) {
    $sql = "SELECT * FROM REPORTEDUSERS";

    // If $username is set, add WHERE clause to filter by username
    if (!empty($username)) {
        $sql = "SELECT * FROM REPORTEDUSERS WHERE username LIKE ?";
        $username = "%$username%";
    }

    $statement = $pdo->prepare($sql);

    // If $username is set, bind the parameter
    if (!empty($username)) {
        $statement->bindParam(1, $username, PDO::PARAM_STR);
    }

    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


// Function to remove a user
function removeUser($pdo, $username) {
    $sql = "DELETE FROM USER WHERE username = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$username]);
}

// Check request method and perform actions accordingly
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET["query"])) {
    try {
        $username = $_GET["query"];
        $result = getReportedUsers($pdo, $username);
        echo json_encode($result);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["remove_user"])) {
    try {
        $username = $_POST["remove_user"];
        removeUser($pdo, $username);
        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    try {
        $result = getReportedUsers($pdo, $username);
        echo json_encode($result);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}
?>
