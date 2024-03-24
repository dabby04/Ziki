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
    <img id="header-img" src="images/headerimg.png" />
    <img class="pfp" src="images/blank-profile-picture.png"/>

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
            <p id="username">@user10101</p>
            <p id="user-bio">User bio short description of user <br> </p>
            </div>
          

            <?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Include your database connection file
    include 'configure.php'; // Change 'db_connection.php' to the actual filename of your database connection script
    
    // Get the logged-in user's ID from the session
    $username = $_SESSION['username'];
    
    // Query to fetch user information from the database
    $sql = "SELECT * FROM users WHERE username = $username";
    $result = mysqli_query($conn, $sql);
    
    // Check if the query was successful
    if($result) {
        // Fetch the user's data
        $userData = mysqli_fetch_assoc($result);
        
        // Output the user's information in HTML
        echo '<div class="profile-info">';
        echo '<p id="username">' . $userData['username'] . '</p>';

        // Calculate and display age based on date of birth (DOB)
        if($userData['DOB']) {
            $dob = new Date($userData['DOB']);
            $today = new Date();
            $age = $dob->diff($today)->y;
            echo '<p id="age">' . $age . ' years old</p>';
        }
        echo '<p id="user-bio">' . $userData['bio'] . '</p>';
        echo '</div>';
        
        // Display additional options if viewing own profile
        echo '<section class="button-container">';
        echo '<a href="editprofile.html"> <button class="rounded-button"> Edit Profile</button></a>';
        echo '<button class="rounded-button" onclick="makeAPost()">Make a Post</button>';
        echo '</section>';
    } 
} else {
    echo 'Error fetching user information';
}
  

?>


            <nav id="tab-tool">
                <div class="text-option" onclick="toggle()"><a href="">Posts</a></div> 
                <div class="text-option"  id="last" onclick="toggle()"><a href=""> Discussions</a></div>
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


