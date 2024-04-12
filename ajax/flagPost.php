<?php
$post = $post??$_POST["post"];
$creator = $creator??$_POST["creator"];
 try{
    require_once "../server/configure.php";

    $sql = "SELECT count FROM reported WHERE postId=?";
    $statement = $pdo ->prepare($sql);
    $statement -> bindValue(1, $post, PDO::PARAM_INT);
    $statement -> execute();

    if($statement->rowCount() > 0){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            while($row = $statement -> fetch(PDO::FETCH_ASSOC)) {
                $sql = "UPDATE reported SET count=? WHERE postId=?";
                $count = $row["count"]+1;
                $statement = $pdo ->prepare($sql);
                $statement -> bindValue(1, $count, PDO::PARAM_INT);
                $statement -> bindValue(2, $post, PDO::PARAM_INT);
                $statement -> execute();
            }
        }else {
            $message = "No posts found";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }else{
                $sql = "INSERT INTO reported VALUES ($post,$creator,1)";
                $statement = $pdo ->prepare($sql);
                $statement -> execute();
            
    }
    }catch(PDOException $e) {
         header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Failed to fetch reported posts:' . $e->getMessage()."$create, $post"));
        exit;
    }