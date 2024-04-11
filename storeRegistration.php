<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Include your database connection file
  require_once "server/configure.php";

  // Retrieve form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $dob = $_POST["dob"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  // Hash the password
  $hashed_password = md5($password);
  $date_joined = date("Y-m-d");

  $sql = "SELECT * from USER WHERE username=? OR email=?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, $username);
  $stmt->bindValue(2, $email);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $message = "Username and/or email already exists";
    echo "<script>alert('$message');
    window.location.href = 'registration.php';</script>";
    exit;
  } else {
    // Insert into the database
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
      $profilePhoto = file_get_contents($_FILES['img']['tmp_name']);

      $query = "INSERT INTO USER (name, email, dob, username, password,dateJoined,profilePhoto) VALUES (?, ?, ?, ?, ?,?,?);";
      $stmt = $pdo->prepare($query);
      $stmt->bindValue(1, $name);
      $stmt->bindValue(2, $email);
      $stmt->bindValue(3, $dob);
      $stmt->bindValue(4, $username);
      $stmt->bindValue(5, $hashed_password);
      $stmt->bindValue(6, $date_joined);
      $stmt->bindValue(7, $profilePhoto);

      $stmt->execute();
      print_r("HERE");
      exec("python graph.py", $output, $return_var);

      // Check the output and return status if needed
      if ($return_var !== 0) {
        $error_message = "Error executing Python script: " . implode("\n", $output);
        echo "<script>alert('$error_message');</script>";
      } else {
        echo "<script>alert('Python script executed successfully!');</script>";
        // Redirect to the login page
        echo "<script>window.location.href = 'login.php';</script>";
      }
    } else {
      $query = "INSERT INTO USER (name, email, dob, username, password,dateJoined) VALUES (?, ?, ?, ?, ?,?);";
      $stmt = $pdo->prepare($query);
      $stmt->bindValue(1, $name);
      $stmt->bindValue(2, $email);
      $stmt->bindValue(3, $dob);
      $stmt->bindValue(4, $username);
      $stmt->bindValue(5, $hashed_password);
      $stmt->bindValue(6, $date_joined);

      $stmt->execute();
      exec("python graph.py", $output, $return_var);

      // Check the output and return status if needed
      if ($return_var !== 0) {
        $error_message = "Error executing Python script: " . print_r($output, true);
        echo "<script>alert('$error_message');</script>";
    }
     else {
        echo "<script>alert('Python script executed successfully!');</script>";
        // Redirect to the login page
        echo "<script>window.location.href = 'login.php';</script>";
      }
    }



    exit;
  }
}
?>
