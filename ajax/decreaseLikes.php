<?php

session_start();
$response = array();
require_once "../server/configure.php";
if (!isset($_SESSION['status'])) {
    // Set response indicating unauthorized access
    $response['status'] = 'error';
    $response['message'] = 'Unauthorized access';
    echo json_encode($response);
} else {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve discussion ID from the POST data
        $discussion_id = $_POST["discussion_id"];
        $reaction = $_POST["type"];

        if ($reaction === "like") {
            $sql = "UPDATE POSTS SET LIKES=likes+1 WHERE id=?";
        } else {
            $sql = "UPDATE POSTS SET dislikes=dislikes+1 WHERE id=?";
        }
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $discussion_id, PDO::PARAM_STR);
        $statement->execute();
        if ($reaction === "like") {
            $sql = "SELECT likes FROM POSTS WHERE id=?";
        } else {
            $sql = "SELECT dislikes FROM POSTS WHERE id=?";
        }
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $discussion_id, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $reactionCount = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($reactionCount);
    } else {
        // If request method is not POST, return an error response
        http_response_code(405); // Method Not Allowed
        die("Only post request allowed");
    }
}
?>