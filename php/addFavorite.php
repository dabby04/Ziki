<?php
$post??$_POST["fav"];
$user??$_POST["user"];
 try{
    require_once "../server/configure.php";
  
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
              $sql = "INSERT INTO favourites VALUES ($user,$post)";
              $statement = $pdo->prepare($sql);
              $statement->execute();
    }else {
        $message = "No posts found";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    }catch(PDOException $e) {
         header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Failed to fetch reported posts: ' . $e->getMessage()));
        exit;
    }
?>