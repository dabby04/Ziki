<?php
session_start();
$user_id = "";
$user_id = $user_id??$_SESSION['id'];
try{
    require_once "../server/configure.php";

  if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try{
        $topic = $_GET["discTopic"];
        $sql="SELECT * FROM comments WHERE postId =?";
        $sql1="SELECT * FROM posts WHERE id=?";
        $stmt= $pdo->prepare($sql1);
        $stmt->bindParam(1, $topic, PDO::PARAM_INT );
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='card text-center'>
                                        <div class='card-header'>
                                          <img id='discussionPFP' class='icons' src='images/blank-profile-picture.png' alt ='disussion pfp'>".$row["creator"]. 
                                          "<div class='dropdown'>
                                          <img id='discDropdown' class='icons' src='images/dropdown.png' alt='dropdown discussion' data-bs-toggle='dropdown' aria-expanded='false'>
                                          <ul class='dropdown-menu'>
                                            <li><a class='dropdown-item' onClick={flagPost(".$row['id'].",".$row['creatorId'].")}>Flag</a></li>
                                            <li><a class='dropdown-item' href='#'>Save</a></li>
                                            <li><a class='dropdown-item' href='#'>Share</a></li>
                                          </ul>
                                          </div>
                                          <img id='discFav' src='images/star.png' alt='favorite discussion'onClick={addFav(".$row["creatorId"].",".$row["id"].")}>
                                         
                                        </div>
                                          <div class='card-body'>
                                              <h5 class='card-title'>".$row["title"]."</h5>
                                              <p class='card-text'>".$row["content"]."</p>
                                          </div>
                                          <div class='card-footer text-body-secondary'>
                                          <img src='images/comment-icon-15.png' alt='comment' id='comment' onClick={addComment(1,".$row['id'].")}"
                                              .$row["created_at"]."

                                              <div class= 'footIcons'>".
                                                $row["likes"]."
                                                <img src='images/like-icon-on-transparent-background-free-png.png' alt= 'like' id='like' onClick={likePost(".$row["id"].",".$row["likes"].")}>
                                                <span id='countDislike'>".
                                                $row["dislikes"]."</span>
                                                <img src='images/like-icon-on-transparent-background-free-png.png' alt= 'dislike' id='dislike' onClick={dislikePost(".$row["id"].",".$row["dislikes"].")}>
                                              </div>
                                          </div>
                                      </div>";
        }
        $statement=$pdo->prepare($sql);
        $statement->bindValue(1, $topic, PDO::PARAM_INT);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            while($row= $statement->fetch(PDO::FETCH_ASSOC)){ // Fetch all rows
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
          } else {
            $message = "No posts found";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }

    }catch(Exception $e){

    }
  }
    
}catch(Exception $e){
    echo "".$e->getMessage()."";
}