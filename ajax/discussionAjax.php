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


  try{
  require_once "../server/configure.php";

  if ($_SERVER['REQUEST_METHOD'] == "GET") {

    try {
      $search_query = ""; // Add wildcards here
      if (isset($_GET["query"])) {
        $search_query = "%" . $_GET["query"] . "%"; // Add wildcards here
        $sql = "SELECT * FROM POSTS WHERE title LIKE ?";
      } else {
        $theme = $_GET["theme"];
        $formattedtheme = strtolower($theme);
        //print_r($formattedtheme);
        $search_query = $formattedtheme; // Add wildcards here
        $sql = "SELECT * FROM POSTS WHERE theme = ?";
      }

      $statement = $pdo->prepare($sql);
      $statement->bindValue(1, $search_query, PDO::PARAM_STR);
      $statement->execute();

      header('Content-Type: application/json');
      if ($statement->rowCount() > 0) {
        // $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
        // echo json_encode($list);
        while($row= $statement->fetch(PDO::FETCH_ASSOC)) {
          echo "<div class='card text-center'>
                                        <div class='card-header'>
                                          <img id='discussionPFP' class='icons' src='images/blank-profile-picture.png' alt ='disussion pfp'>".$row["creator"]. 
                                          "<div class='dropdown'>
                                          <img id='discDropdown' class='icons' src='images/dropdown.png' alt='dropdown discussion' data-bs-toggle='dropdown' aria-expanded='false'>
                                          <ul class='dropdown-menu'>
                                            <li><a class='dropdown-item' href='#'>Flag</a></li>
                                            <li><a class='dropdown-item' href='#'>Save</a></li>
                                            <li><a class='dropdown-item' href='#'>Share</a></li>
                                          </ul>
                                          </div>
                                          <img id='discFav' src='images/star.png' alt='favorite discussion'onClick={addFav(".$row["creatorId"].",".$row["id"].")}>
                                         
                                        </div>
                                          <div class='card-body'>
                                              <h5 class='card-title'>".$row["title"]."</h5>
                                              <p class='card-text'>".$row["content"]."</p>
                                              <form action='specificDiscussion.php' method='GET'>
                                                        <button type='submit' class='btn btn-primary' name='discTopic' value=".$row["id"].">View Discussion</button>
                                                         </form>
                                          </div>
                                          <div class='card-footer text-body-secondary'>"
                                              .$row["created_at"]."

                                              <div class= 'footIcons'>".
                                                $row["likes"]."
                                                <img src='images/like-icon-on-transparent-background-free-png.png' alt= 'like' id='like'>
                                                ".
                                                $row["dislikes"]."
                                                <img src='images/like-icon-on-transparent-background-free-png.png' alt= 'dislike' id='dislike'>
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
