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
    <h1 class="title">Ziki</h1>
    <?php
    error_reporting(E_ALL); 
    ini_set('display_errors', 1);

    session_start();
    require_once 'server/configure.php'; 

    if(isset($_GET['id'])) {
        // Use the user ID from the URL if provided
        $user_id = $_GET['id'];
        
    } else {
        // Use the session user ID if no user ID is specified in the URL
        $user_id = '1';
    }


    // Query to fetch user information from the database
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if($result) {
        // Fetch the user's data
        $userData = mysqli_fetch_assoc($result);
        ?>
    

    <img id="header-img" src="images/headerimg.png" />
    <?php if (!empty($userData['pfp'])): ?>
            <img class="pfp" src="data:image/jpeg;base64,<?php echo base64_encode($userData['pfp']); ?>"/> 
            <?php else: ?>
            <img class="pfp" src="images/blank-profile-picture.png"/>
        <?php endif; ?>

    <div id="postPopup" class="popup">
        <textarea placeholder="Speak your mind..."> </textarea>
        <div class="inputControls">
            <img id="photo_icon" src="images/photo_icon.png"/>
            <button class="postButtons" onclick="submitPost()">Submit</button>
            <button class="postButtons" id="XButton" onclick="closePostPopup()">X</button>
        </div>
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

        <?php
if(!isset($_GET['id'])) {
    // Display the section only if user ID is not retrieved from the URL
    ?>
    <section class="button-container">
        <a href="editprofile.php"> <button class="rounded-button"> Edit Profile</button></a>
        <button class="rounded-button" onclick="makeAPost()">Make a Post</button>
    </section>
    <?php
}
?>

        <?php
    } else {
        echo 'Error fetching user information';
    }
    ?>





    <nav id="tab-tool">
        <div class="text-option" onclick="toggle()"><a href="">Posts</a></div> 
        <div class="text-option" id="last" onclick="toggle()"><a href=""> Discussions</a></div>
        <div class="text-option" onclick="toggle()"><a href=""> Favourites </a></div>
    </nav>

    <div class="post">
        <div class="rectangle"></div>
        <div class="rectangle"><img src=""></div>
        <div class="rectangle"><img src=""></div>
        <div class="rectangle"><img src=""></div>
    </div>
</body>
</html>


