<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/highlight.css" />
  <script type="text/javascript" src="script/login.js"></script>
</head>

<body>
  <?php
  //include "php/status.php";
  //include "server/conn_info.php";

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
      require_once "server/configure.php";
      $form_username = $_POST["username"];
      $form_password = $_POST["password"];

      $sql = "SELECT * FROM USER WHERE username=? AND password=?";
      $sql2 = "SELECT * FROM ADMIN WHERE username=? AND password=?";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(1, $form_username);
      $statement->bindValue(2, md5($form_password));
      $statement->execute();

      $statement2 = $pdo->prepare($sql2);
      $statement2->bindValue(1, $form_username);
      $statement2->bindValue(2, md5($form_password));
      $statement2->execute();
      if ($statement->rowCount() > 0) {
        // User exists in the USER table
        // Fetch the first row
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        // Process the data from $row as needed
        $_SESSION['status'] = "active";
        $_SESSION['username'] = $row["username"];
        
        // Redirect to the home page
        header("Location: home.php");
        exit;
    } else if($statement2->rowCount() > 0){
        // User exists in the ADMIN table
        // Fetch the first row
        $row = $statement2->fetch(PDO::FETCH_ASSOC);
        // Process the data from $row as needed for admin login
        $_SESSION['status'] = "admin";
        $_SESSION['username'] = $row["username"];
        
        // Redirect to the admin page or perform admin-specific actions
        header("Location: admin.php");
        exit;
    } else {
        // Neither user nor admin found
        $message = "Invalid username and/or password";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    
    } catch (PDOException $e) {
      die ($e->getMessage());
    }
  }
  ?>

  <header class="header">
    <h1 class="title"><a href="home.php">Ziki</a></h1>
    <h6 class="subtitle">A place where gen Z can connect</h6>
  </header>
  <form id="form" action="login.php" method="post">
    <div class="input-container">
      <label for="username">Username</label>
      <input type="text" id="username" class="input-field" aria-label="Username" name="username" ,
        placeholder="Username" />
    </div>
    <div class="input-container">
      <label for="password">Password</label>
      <input type="password" id="password" class="input-field" aria-label="Password" name="password" ,
        placeholder="Password" />
    </div>
    <div class="content">

      <div class="registration-link">
        <a href="registration.php">Register here</a>
      </div>
      <button class="button" type="submit">Let’s gooo</button>
  </form>

</body>

</html>