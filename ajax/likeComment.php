<?php
$post = $post??$_POST["post"];
$likes = $likes??$_POST["likes"];
 try{
    require_once "../server/configure.php";
  
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
              $sql = "UPDATE comments SET likes=? WHERE commentId=?";
              $statement = $pdo ->prepare($sql);
              $statement -> bindValue(1, $likes, PDO::PARAM_INT);
              $statement -> bindValue(2, $post, PDO::PARAM_INT);
              $statement -> execute();
    }else {
        $message = "No posts found";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    }catch(PDOException $e) {
         header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Failed to fetch reported posts:' . $e->getMessage()."$create, $post"));
        exit;
    }