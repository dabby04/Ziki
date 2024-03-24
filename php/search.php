<?php
if (isset ($_SESSION["GET"])) {
    try {
        $search_query = $_GET["query"];
        $sql = "SELECT * FROM POSTS JOIN COMMENTS ON POSTS.id=COMMENTS.postId WHERE title LIKE %?%";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $search_query);
        $statement->execute();
    } catch (Exception $e) {
    }
}
?>