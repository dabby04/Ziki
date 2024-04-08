<?php
if (isset ($_SESSION["GET"])) {
    try {
        $search_query = $_GET["query"];
        $sql = "SELECT * FROM POSTS WHERE title LIKE %?%";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $search_query);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //How do I show the discussion and comments?

    } catch (Exception $e) {
    }
}
?>