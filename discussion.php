<?php
  include 'pageheader.php';
  ?>

    <div id="cards">
         <!-- <Button onclick=openDiscussion(discomments)>  -->
    </div>
<?php
  $list = array();
  $jsArray = json_encode($list); // Initialize as an empty JSON array

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
      require_once "server/configure.php";
      $sql = "SELECT * FROM POSTS";
      $statement = $pdo->prepare($sql);
      $statement->execute();

      if ($statement->rowCount() > 0) {
        $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
        $jsArray = json_encode($list);
      } else {
        $message = "No posts found";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    } catch (PDOException $e) {
      die ($e->getMessage());
    }
  }
?>
    <script>
        //var comments = ["Discussion 1", "Discussion 2", "Discussion 3", "Discussion 4"];
        //let discTitle;
        var topics = <?php echo $jsArray; ?>;
        window.onload= function()
            {
                console.log(topics);
                //using the name of the discussion, generate related content
                const displayComments = document.getElementById("cards");
                //const comments = ["Discussion 1", "Discussion 2", "Discussion 3", "Discussion 4"];
                //displayComments.innerHTML= comments.map((e)=>{
                  displayComments.innerHTML= topics.map((e)=>{
                    return `<div class="card text-center">
                          <div class="card-header">
                            <img id="discussionPFP" class="icons" src="images/blank-profile-picture.png" alt ="disussion pfp">
                            Username 
                            <div class="dropdown">
                            <img id="discDropdown" class="icons" src="images/dropdown.png" alt="dropdown discussion" data-bs-toggle="dropdown" aria-expanded="false">
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Flag</a></li>
                              <li><a class="dropdown-item" href="#">Save</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                            </ul>
                            </div>
                            <img id="discFav" src="images/star.png" alt="favorite discussion">
                           
                          </div>
                            <div class="card-body">
                                <h5 class="card-title">${e}</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <form action="specificDiscussion.php" method="POST">
                                          <button type="submit" class="btn btn-primary" name="discTopic" value=${e}>View Discussion</button>
                                </form>
                                <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasBottomLabel">${e}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body small" id="discomments">
                                        ...
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary">
                                2 days ago
                            </div>
                        </div>`;
            }).join("");
            }
    </script>
