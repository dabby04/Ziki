<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

session_start(); // Start the session

if (!isset($_SESSION['id'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit;
}

// Check if the user is an admin
if ($_SESSION['status'] === "admin") {
    // Handle admin profile differently or redirect to admin page
    header("Location: admin.php");
    exit;
}

// If the user is not an admin, proceed to fetch user data using their ID
// You should have your database connection code here

// Retrieve the user ID from the session
$user_id = $_SESSION['id'];

try {
    // Connect to the database using PDO
    require_once "server/configure.php";
    $pdo = new PDO("mysql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;charset=utf8mb4", $DBUSER, $DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch user information from the database
    $sql = "SELECT * FROM USER WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/pageheader.css" />
    <link rel="stylesheet" href="css/profile.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="script/profile.js"></script>
</head>

<header class="header">
    <h1 class="title"><a href="home.php">Ziki</a></h1>
    <?php if (!empty($userData['profilePhoto'])): ?>
        <img id="header-img" src="images/headerimg.png" />
        <img class="pfp" src="data:image/jpeg;base64"  style=" border-radius: 50%;
    width: 200px;
    position: absolute;
    top: 60%;
    left: 50%;
    right: 50%;
    bottom: 0%;
    transform: translate(-50%, -50%);",<?php echo base64_encode($userData['profilePhoto']); ?>"/>
    <?php else: ?>
        <img id="header-img" src="images/headerimg.png" />
        <img class="pfp" src="images/blank-profile-picture.png"  style="  border-radius: 50%;
    width: 200px;
    position: absolute;
    top: 60%;
    left: 50%;
    right: 50%;
    bottom: 0%;
    transform: translate(-50%, -50%);"/>
    <?php endif; ?>
    
    <!-- Post Popup Form -->
    <div id="postPopup" class="popup">
        <form id="postForm" action="savePost.php" method="post" enctype="multipart/form-data">
            <textarea name="content" placeholder="Speak your mind..."></textarea>
            <div class="inputControls">
            <input type="text" name="title" placeholder="Enter title" is="postTitle" style="
    display: flex;
    position: absolute;
    top: -825%;
    width: 30em;
    background-color: #d9d9d9;
    left: -4%;
    border-radius: 8px;
">
                <button type="button" class="postButtons" id="XButton" onclick="closePostPopup()" style="  border: none;
  background-color:  #d9d9d9;
  width: 20pt;
  position: absolute;
  bottom: 720%;
  right: -2%;
  font-size: 18px;
  cursor: pointer;
  margin-right: 20px;"
            >X</button>
                <label for="postImage">
                    <img id="photo_icon" src="images/photo_icon.png" alt="Photo Icon"/>
                </label>
                <input type="file" id="postImage" name="postImage" accept="image/*">
                <button type="submit" class="postButtons">Submit</button>
            </div>
        </form>
    </div>
</header>

<body>
    <div class="profile-info">
        <p id="username">@<?php echo $userData['username']; ?></p>
        <?php
        // Calculate and display age based on date of birth (DOB)
        if($userData['DOB']) {
            $dob = new DateTime($userData['DOB']);
            $today = new DateTime();
            $age = $dob->diff($today)->y;
            ?>
            <p id="age"><?php echo $age; ?> years old</p>
            <?php
        }
        ?>
        <p id="user-bio"><?php echo $userData['bio']; ?></p>
    </div>


    <?php if(!isset($_GET['id'])): ?>
    <section class="button-container">
        <a href="editprofile.php"> <button class="rounded-button"> Edit Profile</button></a>
        <button class="rounded-button" onclick="makeAPost()">Make a Post</button>
    </section>
    <?php endif; ?>

    <!-- Navigation -->
    <nav id="tab-tool">
        <div class="text-option" onclick="toggle()"><a href="">Posts</a></div> 
        <div class="text-option" id="last" onclick="toggle()"><a href=""> Discussions</a></div>
        <div class="text-option" onclick="toggle()"><a href="">Likes</a></div>


