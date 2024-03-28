 <?php

// require_once "server/configure.php";

// if(isset($_GET['query'])) {
//   $search_query = "%" . $_GET["query"] . "%";
//   $sql = "SELECT * FROM POSTS WHERE title LIKE ?";
//   $statement = $pdo->prepare($sql);
//   $statement->bindValue(1, $search_query, PDO::PARAM_STR);
//   $statement->execute();

//   if ($statement->rowCount() > 0) {
//     $list = $statement->fetchAll(PDO::FETCH_ASSOC);
//     foreach ($list as $item) {
//       // Output HTML for each post
//       echo "<div class='card text-center'>";
//       // Output other details of the post
//       echo "</div>";
//     }
//   } else {
//     echo "<p>No posts found</p>";
//   }
// }

// if(isset($_GET['getThemes'])) {
//   $sql = "SELECT DISTINCT theme FROM POSTS";
//   $statement = $pdo->prepare($sql);
//   $statement->execute();
//   $themes = $statement->fetchAll(PDO::FETCH_COLUMN);
//   echo json_encode(['themes' => $themes]);
// }

$list = array();
$jsArray = json_encode($list); // Initialize as an empty JSON array

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
try{
require_once "../server/configure.php";
$sql = "SELECT * FROM POSTS";
$statement = $pdo->prepare($sql);
$statement->execute();

if ($statement->rowCount() > 0) {
  $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
  $jsArray = json_encode($list);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {

  try {
    $search_query = ""; // Add wildcards here
    if (isset($_GET["query"])) {
      $search_query = "%" . $_GET["query"] . "%"; // Add wildcards here
      $sql = "SELECT * FROM POSTS WHERE title LIKE ?";
    } else {
      $theme = $_GET["theme"];
      $formattedtheme = strtolower($theme);
      print_r($formattedtheme);
      $search_query = $formattedtheme; // Add wildcards here
      $sql = "SELECT * FROM POSTS WHERE theme = ?";
    }

    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $search_query, PDO::PARAM_STR);
    $statement->execute();


    if ($statement->rowCount() > 0) {
      $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
      echo json_encode($list);
    } else {
      $message = "No posts found";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

  } catch (Exception $e) {
    // Handle exception
    die($e->getMessage());
  }
}
}catch(PDOException $e) {
  header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(array('error' => 'Failed to fetch reported posts: ' . $e->getMessage()));
    exit;
}
?>
