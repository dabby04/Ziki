<?php
// This file fetches the reported posts from the database and returns them as JSON

try {
    require_once "../server/configure.php";
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ( isset($_POST['postId']) && !empty($_POST['postId']) &&isset($_POST['userId']) && !empty($_POST['userId'])) {
        $postId= $_POST['postId'];
        $userId= $_POST['userId'];
        // $sql = "DELETE FROM REPORTED WHERE postId = ? AND userId=?";
       
        // $statement = $pdo->prepare($sql);
       
        // $statement->bindValue(1, $postId, PDO::PARAM_STR);
        // $statement->bindValue(2, $userId, PDO::PARAM_STR);
        
        // $statement->execute();
        
        // $sql = "DELETE FROM COMMENTS WHERE postId = ?";
       
        // $statement = $pdo->prepare($sql);
       
        // $statement->bindValue(1, $postId, PDO::PARAM_STR);
        
        // $statement->execute();

        // $sql = "DELETE FROM FAVOURITES WHERE postId = ?";
       
        // $statement = $pdo->prepare($sql);
       
        // $statement->bindValue(1, $postId, PDO::PARAM_STR);
        
        // $statement->execute();

        $sql2=" DELETE FROM POSTS WHERE id = ?";
        $statement2 = $pdo->prepare($sql2);
        $statement2->bindValue(1, $postId, PDO::PARAM_STR);
        $statement2->execute();
    }}
    $sql = "SELECT POSTS.title, USER.username,POSTS.id, REPORTED.userId FROM REPORTED JOIN POSTS ON REPORTED.postId=POSTS.id JOIN USER ON REPORTED.userId=USER.id ORDER BY REPORTED.count DESC";
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
