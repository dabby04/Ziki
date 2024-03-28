<?php
$list = array();
$jsArray = json_encode($list); // Initialize as an empty JSON array

require_once "server/configure.php";
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
      $jsArray = json_encode($list);
    } else {
      $message = "No posts found";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

  } catch (Exception $e) {
    // Handle exception
    die($e->getMessage());
  }
}
//  $type="";
// if (isset($_GET["query"])) {
//         $type = "query";
//       } else {
//         $type = "theme";
//       }
?>
<!DOCTYPE html>
<html>

<head>
  <div class="wrapper">
    <?php include "pageheader.php" ?>
  </div>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="script/discussion.js"></script>
  <!-- <script>
    // var type = '<?php //echo $type; ?>';
    // console.log(type);
    // var value = '<?php //echo $_GET[$type]; ?>';
    // console.log(value);
    // populate(type, value);
  </script> -->
  <script>
    var topics = <?php echo $jsArray; ?>;
    window.onload = function () {
      console.log(topics);
      //using the name of the discussion, generate related content
      const displayComments = document.getElementById("cards");
      displayComments.innerHTML = topics.map((e) => {
        return `<div class="card text-center">
                          <div class="card-header">
                            <img id="discussionPFP" class="icons" src="images/blank-profile-picture.png" alt ="disussion pfp">
                            ${e.creator} 
                            <div class="dropdown">
                            <img id="discDropdown" class="icons" src="images/dropdown.png" alt="dropdown discussion" data-bs-toggle="dropdown" aria-expanded="false">
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Flag</a></li>
                              <li><a class="dropdown-item" href="#">Save</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                            </ul>
                            </div>
                            <img class="discFav" src="images/star.png" alt="favorite discussion" onClick={addFavorite}>
                           
                          </div>
                            <div class="card-body">
                                <h5 class="card-title">${e.title}</h5>
                                <p class="card-text">${e.content}</p>
                                <form action="specificDiscussion.php" method="GET">
                                          <button type="submit" class="btn btn-primary" name="discTopic" value=${e.id}>View Discussion</button>
                                           </form>
                            </div>
                            <div class="card-footer text-body-secondary">
                                ${e.created_at}
                                <div class= "footIcons">
                                  ${e.likes}
                                  <img src="images/like-icon-on-transparent-background-free-png.png" alt= "like" id="dislike">
                                  </div>
                                  <div class= "footicons">
                                  ${e.dislikes}
                                  <img src="images/like-icon-on-transparent-background-free-png.png" alt= "like" id="like">
                                </div>
                            </div>
                        </div>`;
      }).join("");
    }
    var fav = 0;
    $(document).on('click', '.discFav', function() {
      
      if(fav==0)
      {
        $(this).css({
          'background-color': 'Yellow'
        });
        fav =1;
      }
      else{
        $(this).css({
          'background': 'none'
        });
        fav =0;
      }

    });

    var like = 0;
    $(document).on('click', '#like', function() {
  if(like==0)
  {
    $(this).css({
      'background-color': 'red'
    });
    like =1;
  }
  else{
    $(this).css({
      'background': 'none'
    });
    like =0;
  }
});

var dislike = 0;
$(document).on('click', '#dislike', function() {
  // Add your code here for the #dislike click event
  if(dislike==0)
  {
    $(this).css({
      'background-color': 'red'
    });
    dislike =1;
  }
  else{
    $(this).css({
      'background': 'none'
    });
    dislike =0;
  }
});

    
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <!-- <div id="filter">
  </div> -->
  <div id="cards">
  </div>
  <footer>
  <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
            <ul class="breadcrumb">
            <?php 
            $current ='discussion';
            //print_r($_SESSION['prevPage']);
                    if(isset($_SESSION['prevPage']))
                    {
                        $previous = $_SESSION['prevPage'];
                        echo "<li class='breadcrumb-item'><a href='#'>$previous </a></li>";
                        echo "<li class='breadcrumb-item'><a href='#'>$current </a></li>";
                    }
                   else
                   {
                    echo "<li class='breadcrumb-item'><a href='#'>$current </a></li>";
                    }
                    $_SESSION['prevPage']=$current;?>
            </ul>
          </nav>
    </footer>
</body>

</html>