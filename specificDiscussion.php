<?php
$list = array();
$title = array();
$jsArray = json_encode($list);
$discussion = json_encode($title); // Initialize as an empty JSON array

require_once "server/configure.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $search_query = ""; // Add wildcards here
        $theme = $_GET["discTopic"];
        $user_id = $_SESSION['id'];
        // Fetch comments
        $sql = "SELECT * FROM COMMENTS  WHERE postId = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$user_id]);

        if ($statement->rowCount() > 0) {
            $listComments = $statement->fetchAll(PDO::FETCH_ASSOC);
            $jsArray = json_encode($listComments);
        } else {
            $message = "No comments found";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

        // Fetch posts' title and content
        $sql1 = "SELECT title, content FROM POSTS WHERE id = ?";
        $statement1 = $pdo->prepare($sql1);
        $statement1->execute([$user_id]);

        if ($statement1->rowCount() > 0) {
            $listPosts = $statement1->fetchAll(PDO::FETCH_ASSOC);
            $discussion = json_encode($listPosts);
        } else {
            $message = "No posts found";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
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
      console.log(topic);
      const displayComments = document.getElementById("discomments");
      displayComments.innerHTML = discussion.map((e) => {
        return `<h2>${e.title}</h2>
            <p>${e.content}</p>`;
      }).join("") + comments.map((e) => {
        let commentHTML = `<div id="individualComment">`;

        if (e.profilePhoto) {
          commentHTML += `<img src="${e.img}" alt="Profile Photo" id="commentPFP">`;
        }

        commentHTML += `${e.content}</div><br/>`;
        return commentHTML;
      });
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
