
<?php
$list = array();
$jsArray = json_encode($list); // Initialize as an empty JSON array
$topic = $_POST['discTopic'];
echo $topic;
// if ($_SERVER['REQUEST_METHOD'] == "POST") {
  try {
    require_once "server/configure.php";
    $sql = "SELECT * FROM COMMENTS WHERE postId = $topic";
    $statement = $pdo->prepare($sql);
    //$statement->bindValue(1, $topic);
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
        window.onload= function()
            {
                var topic = "<?php echo $topic; ?>";
                console.log(topic)
                //let discTitle = e;
                //using the name of the discussion, generate related content
                const displayComments = document.getElementById("discomments");
                //const comments = ["Comment 1", "Comment 2", "Comment 3", "Comment 4"];
                displayComments.innerHTML= comments.map((e)=>{
                    return `<div id="individualComment">
                      <img src="images/blank-profile-picture.png" alt="blank pfp" id="commentPFP">
                      ${e.}
                      </div><br/>`;
                }).join("");
            }
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
    <div id="discomments">
        <?php echo `<h2>$topic</h2>`?>
         
    </div>

</body>

</html>
