<?php
require_once "../server/configure.php";

try {
    $sql="SELECT postId FROM FAVOURITES ";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $postIds= $statement->fetchAll(PDO::FETCH_ASSOC);
        $postIdArray = array();
        foreach ($postIds as $row) {
            $postIdArray[] = $row['postId'];
        }

        $postIdString = implode(',', $postIdArray);
        $sqlPosts = "SELECT COMMENTS.postId,COMMENTS.likes,creator,POSTS.title,COMMENTS.content FROM COMMENTS JOIN USER ON COMMENTS.userId=USER.id JOIN POSTS ON COMMENTS.postId=POSTS.id ORDER BY COMMENTS.likes DESC LIMIT 2";
        $statementPosts = $pdo->prepare($sqlPosts);
        $statementPosts->execute();
        $posts = $statementPosts->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($posts);
    }
} 
catch (PDOException $error) {
    die($error->getMessage());
}
?>