<?php
require_once "server/configure.php";

if(isset($_GET['query'])) {
  $search_query = "%" . $_GET["query"] . "%";
  $sql = "SELECT * FROM POSTS WHERE title LIKE ?";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $search_query, PDO::PARAM_STR);
  $statement->execute();

  if ($statement->rowCount() > 0) {
    $list = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($list as $item) {
      // Output HTML for each post
      echo "<div class='card text-center'>";
      // Output other details of the post
      echo "</div>";
    }
  } else {
    echo "<p>No posts found</p>";
  }
}

if(isset($_GET['getThemes'])) {
  $sql = "SELECT DISTINCT theme FROM POSTS";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $themes = $statement->fetchAll(PDO::FETCH_COLUMN);
  echo json_encode(['themes' => $themes]);
}
?>
