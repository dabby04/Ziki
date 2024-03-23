<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  print_r("HERE");
  // Include your database connection file
  require_once "server/configure.php";

  // Retrieve form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $dob = $_POST["dob"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $profilePhoto = $_POST["img"];
  // Hash the password
  $hashed_password = md5($password);
  $date_joined = date("Y-m-d");


  // Insert into the database
  if (isset ($_POST["img"])) {
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
  }


  // Redirect to the login page
  header("Location: login.php");
  exit;
}
?>