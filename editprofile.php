<?php

error_reporting(E_ALL); ini_set('display_errors', 1);


session_start();

require_once 'server/configure.php'; 

if(isset($_GET['id'])) {
    // Use the user ID from the URL if provided
    $user_id = $_GET['id'];
} else {
    // Use the session user ID if no user ID is specified in the URL
    $user_id = '1';
}

// Fetch user information from the database
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$userData = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editprofile.css" />
    <script src="script/editprofile.js"></script>
    <title>Edit Profile</title>
</head>
<body>
<header>
    <nav></nav>
    <h1 id="main-logo"><a href="home.html">Ziki</a></h1>
</header>

<div id="main">
    <div id="profile-container">

    <?php
        // Check if the user has a profile picture
        if(!empty($userData['pfp'])) {
            // Output the profile picture as an image
            echo '<img id="pfp" src="data:image/jpeg;base64,'.base64_encode($userData['pfp']).'" />';
        } else {
            // Output a default profile picture if the user does not have one
            echo '<img id="pfp" src="images/blank-profile-picture.png" />';
        }
        ?>

       
        <div class="upload"> <input type="file" id="img" name="img" accept="image/*"></div>
        

        <h3 id="user-tag">@<?php echo $userData['username']; ?></h3>
        
        <!-- Populate form fields with user's information -->
        <form id="change-info" onsubmit="return check()" action="profile.php" method="post">
            <p id="email-entry"> <label> <img class="icon" src="images/mail-icon.png" alt="email icon"/> </label> <input type="email" value="<?php echo $userData['email']; ?>" placeholder="<?php echo $userData['email']; ?>"/></p>
            <p id="date-entry"> <label> <img class="icon" src="images/calendar-icon.png"  alt="calendar icon"/> </label> <input type="date" value="<?php echo $userData['DOB']; ?>" placeholder="<?php echo $userData['DOB']; ?>"/></p>
            <p id="bio"> <label> <img class="icon" src="images/user.png" alt="person icon"/> </label> <input type="text" value="<?php echo $userData['bio']; ?>" placeholder="<?php echo $userData['bio']; ?>"/></p>
            <input type="submit" value="Done" id="done"/>
        </form>
    </div>
</div>

</body>
</html>
