<?php
$post = $post??$_POST["post"];
$creator = $creator??$_POST["creator"];
$comment = $comment??$_POST["comment"];
 try{
    require_once "../server/configure.php";
    $sql = "INSERT INTO comments(userId, postId, content) VALUES ($creator,$post,?)";
    $statement = $pdo ->prepare($sql);
    $statement -> bindParam(1, $comment, PDO::PARAM_STR);
    $statement -> execute();

    while($row = $statement -> fetch(PDO::FETCH_ASSOC)){
        echo"<div class='card text-center'>
        <div class='card-header'>
          <img id='discussionPFP' class='icons' src='images/blank-profile-picture.png' alt ='disussion pfp'> 
          <div class='dropdown'>
          <img id='discDropdown' class='icons' src='images/dropdown.png' alt='dropdown discussion' data-bs-toggle='dropdown' aria-expanded='false'>
          <ul class='dropdown-menu'>
            <li><a class='dropdown-item' onClick={flagPost(".$row['commentId'].",".$row['userId'].")}>Flag</a></li>
            <li><a class='dropdown-item' href='#'>Save</a></li>
            <li><a class='dropdown-item' href='#'>Share</a></li>
          </ul>
          </div>
         
        </div>
          <div class='card-body'>
              <p class='card-text'>".$row["content"]."</p>
          </div>
          <div class='card-footer text-body-secondary'>"
              .$row["created_at"]."

              <div class= 'footIcons'>".
                $row["likes"]."
                <img src='images/like-icon-on-transparent-background-free-png.png' alt= 'like' id='like' onClick={likePost(".$row["commentId"].",".$row["likes"].")}>
                <span id='countDislike'>".
                $row["dislikes"]."</span>
                <img src='images/like-icon-on-transparent-background-free-png.png' alt= 'dislike' id='dislike' onClick={dislikePost(".$row["commentId"].",".$row["dislikes"].")}>
              </div>
          </div>
      </div>";
    }
            
    
    }catch(PDOException $e) {
         header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Failed to fetch reported posts:' . $e->getMessage()."$create, $post"));
        exit;
    }