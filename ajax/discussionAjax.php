 <?php

$list = array();
$jsArray = json_encode($list);


  try{
  require_once "../server/configure.php";

  if ($_SERVER['REQUEST_METHOD'] == "GET") {

    try {
      $search_query = ""; 
      if (isset($_GET["query"])) {
        $search_query = "%" . $_GET["query"] . "%";
        $sql = "SELECT * FROM POSTS WHERE title LIKE ?";
      } else {
        $theme = $_GET["theme"];
        $formattedtheme = strtolower($theme);
        //print_r($formattedtheme);
        $search_query = $formattedtheme;
        $sql = "SELECT * FROM POSTS WHERE theme = ?";
      }

      $statement = $pdo->prepare($sql);
      $statement->bindValue(1, $search_query, PDO::PARAM_STR);
      $statement->execute();

      header('Content-Type: application/json');
      if ($statement->rowCount() > 0) {
        while($row= $statement->fetch(PDO::FETCH_ASSOC)) {
          echo "<div class='card text-center'>
                                        <div class='card-header'>
                                          <img id='discussionPFP' class='icons' src='data:image/jpeg;base64,'" . base64_encode($row["profilePhoto"]) . "' alt='profile photo'>".$row["creator"]. 
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
    <img id ='postPic' src='data:image/jpeg;base64,". base64_encode($row["img"])."' alt='profile photo'>
    <form action='specificDiscussion.php' method='GET'>
        <button type='submit' class='btn btn-primary' name='discTopic' value='".$row["id"]."'>View Discussion</button>
    </form>
</div>

                                          <div class='card-footer text-body-secondary'>"
                                              .$row["created_at"]."
                                              
                                              <div class= 'footIcons'><span id='countLike'>".
                                                $row["likes"]."</span>
                                                <img src='images/like-icon-on-transparent-background-free-png.png' alt= 'like' id='like' onClick={likePost(".$row["id"].",".$row["likes"].")}>
                                                <span id='countDislike'>".
                                                $row["dislikes"]."</span>
                                                <img src='images/like-icon-on-transparent-background-free-png.png' alt= 'dislike' id='dislike' onClick={dislikePost(".$row["id"].",".$row["dislikes"].")}>
                                              </div>
                                          </div>
                                      </div>";
        }
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
