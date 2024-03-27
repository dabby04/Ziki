<?php
$list = array();
$title = array();
$jsArray = json_encode($list);
$discussion = json_encode($title); // Initialize as an empty JSON array
// if ($_SERVER['REQUEST_METHOD'] == "POST") {

require_once "server/configure.php";
if ($_SERVER['REQUEST_METHOD'] == "GET") {

  try {
    $search_query = ""; // Add wildcards here
    $theme = $_GET["discTopic"];
    print_r($theme);

    $sql = "SELECT * FROM COMMENTS  WHERE postId = ?";

    $statement = $pdo->prepare($sql);
    $statement->execute([$theme]);

    if ($statement->rowCount() > 0) {
      $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
      $jsArray = json_encode($list);
    } else {
      $message = "No posts found";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $sql1 = "SELECT title, content FROM POSTS WHERE id = ?";

    $statement1 = $pdo->prepare($sql1);
    $statement1->execute([$theme]);

    if ($statement1->rowCount() > 0) {
      $list = $statement1->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
      $discussion = json_encode($list);
    } else {
      $message = "No posts found";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

// }
?>
<!DOCTYPE html>
<html>

<head>
  <div class="wrapper">
    <?php include "pageheader.php" ?>
  </div>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script>
    var comments = <?php echo $jsArray; ?>;
    var discussion = <?php echo $discussion; ?>;
    window.onload = function () {
      var topic = "<?php echo $topic; ?>";
      console.log(topic)
      //let discTitle = e;
      //using the name of the discussion, generate related content
      const displayComments = document.getElementById("discomments");
      //const comments = ["Comment 1", "Comment 2", "Comment 3", "Comment 4"];
      displayComments.innerHTML = discussion.map((e) => {
        return `<h2>${e.title}</h2>
            <p>${e.content}</p>`;
      }).join("") + comments.map((e) => {
        let commentHTML = `<div id="individualComment">`;

        // Check if profile photo exists
        if (e.img) {
          commentHTML += `<img src="${e.img}" alt="Profile Photo" id="commentPFP">`;
        } 
        // Add comment content
        commentHTML += `${e.content}</div><br/>`;

        return commentHTML;
      }).join("");
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <div id="discomments">

  </div>

</body>

</html>