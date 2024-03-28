<?php
// $list = array();
// $jsArray = json_encode($list); // Initialize as an empty JSON array

// // if ($_SERVER['REQUEST_METHOD'] == "POST") {

// require_once "server/configure.php";
// $sql = "SELECT * FROM POSTS";
// $statement = $pdo->prepare($sql);
// $statement->execute();

// if ($statement->rowCount() > 0) {
//   $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
//   $jsArray = json_encode($list);
// }

// if ($_SERVER['REQUEST_METHOD'] == "GET") {

//   try {
//     $search_query = ""; // Add wildcards here
//     if (isset($_GET["query"])) {
//       $search_query = "%" . $_GET["query"] . "%"; // Add wildcards here
//       $sql = "SELECT * FROM POSTS WHERE title LIKE ?";
//     } else {
//       $theme = $_GET["theme"];
//       $formattedtheme = strtolower($theme);
//       print_r($formattedtheme);
//       $search_query = $formattedtheme; // Add wildcards here
//       $sql = "SELECT * FROM POSTS WHERE theme = ?";
//     }

//     $statement = $pdo->prepare($sql);
//     $statement->bindValue(1, $search_query, PDO::PARAM_STR);
//     $statement->execute();


//     if ($statement->rowCount() > 0) {
//       $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
//       $jsArray = json_encode($list);
//     } else {
//       $message = "No posts found";
//       echo "<script type='text/javascript'>alert('$message');</script>";
//     }

//   } catch (Exception $e) {
//     // Handle exception
//     die($e->getMessage());
//   }
// }

// }
?>
<!DOCTYPE html>
<html>

<head>
  <div class="wrapper">
    <?php include "pageheader.php"; 
    
    $previous=$_SESSION['currentPage'];
    $_SESSION['currentPage']="discussions";
?>
  </div>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>
    
    // var topics = <?php echo $jsArray; ?>;
    window.onload = function () {
      $(document).ready(function () {
            function fetchDiscussions() {
                $.ajax({
                    url: 'ajax/discussionAjax.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        updateDiscussions(data);
                    },
                    error: function (xhr, status, error) {
                        console.error('Failed to fetch reported posts: ' + error);
                    }
                });
            }

            function updateDiscussions(posts) {
                const displayReported = $('#cards');
                displayReported.empty();
                $.each(posts, function (index, post) {
                    var card = $('<div class="card text-center"></div>');
                    var head = $('<div class="card-header"></div>').text('<img id="discussionPFP" class="icons" src="images/blank-profile-picture.png" alt ="disussion pfp">' + post.username );
                    var paragraph = $('<p></p>').text(post.title);
                    var button = $('<button class="remove">Remove</button>');
                    fieldset.append(legend, paragraph, button);
                    displayReported.append(fieldset);
                });
            }

            // Fetch reported posts initially
            fetchReportedPosts();

            // Fetch reported posts every 60 seconds
            setInterval(fetchReportedPosts, 60000);
        });
      
              function showDiscussions(id)
              {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","ajax/discussionAJAX.php?theme="+id,true);
                xmlhttp.send();
              }

              setInterval(function() {
            showDiscussions(<?php echo $_GET['theme']?>);
        }, 60000);

    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>

  <div id="filter">
  </div>
  <div id="cards">
  
    
  </div>
<footer>
<nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
            <ul class="breadcrumb">
            <?php 
            print_r($_SESSION['prevPage']);
                    if(isset($_SESSION['prevPage']))
                        echo "<li class='breadcrumb-item'><a href='#'> {$previous}</a></li>";
                   else
                       echo "<li class='breadcrumb-item'><a href='#'> {$_SESSION['currentPage']}</a></li>";?>
            </ul>
          </nav>
</footer>
</body>

</html>