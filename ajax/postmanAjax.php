<?php
// This file fetches the reported posts from the database and returns them as JSON

try {
    require_once "../server/configure.php";
    $sql = "SELECT POSTS.title, USER.username FROM REPORTED JOIN POSTS ON REPORTED.postId=POSTS.id JOIN USER ON REPORTED.userId=USER.id ORDER BY REPORTED.count DESC";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $reportedPosts = [];
    if ($statement->rowCount() > 0) {
        $reportedPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    header('Content-Type: application/json');
    echo json_encode($reportedPosts);
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(array('error' => 'Failed to fetch reported posts: ' . $e->getMessage()));
    exit;
}
?>
