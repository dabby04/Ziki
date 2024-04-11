<?php
session_start();
$response = array();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "admin") {
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
            $sql = "UPDATE POSTS SET LIKES=? WHERE id=?";
        } else {
            $sql = "UPDATE POSTS SET dislikes=? WHERE id=?";
        }
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $reaction, PDO::PARAM_STR);
        $statement->bindValue(2, $discussion_id, PDO::PARAM_STR);
        $statement->execute();

        if ($reaction === "like") {
            $sql = "SELECT likes FROM POSTS WHERE id=?";
        } else {
            $sql = "SELECT dislikes FROM POSTS WHERE id=?";
        }
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $reaction, PDO::PARAM_STR);
        $statement->bindValue(2, $discussion_id, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $reactionCount = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        // Dummy response (replace with actual response if needed)
        echo "Likes for discussion with ID $reaction increased/decreased successfully.";
    } else {
        // If request method is not POST, return an error response
        http_response_code(405); // Method Not Allowed
        echo "Error: Only POST requests are allowed.";
    }
}
?>