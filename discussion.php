
<?php

 $type="";
if (isset($_GET["query"])) {
        $type = "query";
      } else {
        $type = "theme";
      }
?>
<!DOCTYPE html>
<html>

<head>
  <div class="wrapper">
    <?php include "pageheader.php";?>
  </div>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="script/discussion.js"></script>

  <script>

    var type = '<?php echo $type; ?>';
    //console.log(type);
    var value = '<?php echo $_GET[$type]; ?>';
    //console.log(value);
    //populate(type, value);
  </script> 


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <link href="css/discussion.css" rel="stylesheet">
</head>
<?php
$list = array();
$jsArray = json_encode($list); // Initialize as an empty JSON array

try {
    require_once "server/configure.php";

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $search_query = ""; // Add wildcards here
        if(isset($_GET["query"])) {
            $search_query = "%" . $_GET["query"] . "%"; // Add wildcards here
            $sql = "SELECT * FROM POSTS WHERE title LIKE ?";
        } else {
            $theme = $_GET["theme"];
            $formattedtheme = strtolower($theme);
            $search_query = $formattedtheme; // Add wildcards here
            $sql = "SELECT * FROM POSTS WHERE theme = ?";
        }
      
        $statement = $pdo->prepare($sql);
        $statement->execute([$search_query]);

        if ($statement->rowCount() > 0) {
            $list = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
            $jsArray = json_encode($list);
        } else {
            $message = "No posts found";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
} catch (PDOException $e) {
    die ($e->getMessage());
}
?>

<body onload="discussion(type,value)">
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
    <script>setInterval(discussion(type,value),30000)</script>
</body>

</html>
