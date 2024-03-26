<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editprofile.css" />
    <script src="script/editprofile.js"></script>
    <title>Edit Profile</title>
</head>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'server/configure.php';

if (!isset($_SESSION['id'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit;
} else {
    $user_id = $_SESSION['id'];
}

// Check if the user is an admin
if ($_SESSION['status'] === "admin") {
    // redirect to admin page
    header("Location: admin.php");
    exit;
}
?>

<body>
    <header>
        <nav></nav>
        <h1 id="main-logo"><a href="home.html">Ziki</a></h1>
    </header>

    <?php

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;charset=utf8mb4", $DBUSER, $DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch user information from the database
    $sql = "SELECT * FROM USER WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize an array to store validation errors
    $errors = array();

    // Validate username
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $errors[] = "Username is required.";
    }

    // Validate email
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $errors[] = "Email is required.";
    }

    // Validate date of birth
    if (isset($_POST['dob']) && !empty($_POST['dob'])) {
        $dob = $_POST['dob'];
    } else {
        $errors[] = "Date of Birth is required.";
    }

    // Validate bio
    if (isset($_POST['bio'])) {
        $bio = $_POST['bio'];
    }

    // Check if there are any validation errors
    if (empty($errors)) {
        // Proceed with updating user's information in the database
        try {
            // Connect to the database using PDO
            $pdo = new PDO("mysql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;charset=utf8mb4", $DBUSER, $DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if a file was uploaded

if (isset($_FILES['img'])) {
    // Read the contents of the uploaded file
    $profilePhoto = file_get_contents($_FILES['img']['tmp_name']);
} elseif (isset($_POST['removePhoto'])) {
    // If the user selected to remove the profile photo, set it to null
    $defaultProfilePicturePath = 'images/blank-profile-picture.png'; // Provide the path to your default profile picture
    $profilePhoto = file_get_contents($defaultProfilePicturePath);
} else {
    // Set the default profile picture
    $defaultProfilePicturePath = 'images/blank-profile-picture.png'; // Provide the path to your default profile picture
    $profilePhoto = file_get_contents($defaultProfilePicturePath);
}


            // Update user's information in the database
            // Update user's information in the database
$updateSql = "UPDATE USER SET email = ?, DOB = ?, bio = ?, profilePhoto = ? WHERE id = ?";
$updateStmt = $pdo->prepare($updateSql);
$updateStmt->bindParam(1, $email, PDO::PARAM_STR);
$updateStmt->bindParam(2, $dob, PDO::PARAM_STR);
$updateStmt->bindParam(3, $bio, PDO::PARAM_STR);
$updateStmt->bindParam(4, $profilePhoto, PDO::PARAM_LOB);
$updateStmt->bindParam(5, $_SESSION['id'], PDO::PARAM_INT);
$updateStmt->execute();


            // Check if the update was successful
            if ($updateStmt->rowCount() > 0) {
                // Redirect back to the profile page after updating
                header("Location: profile.php");
                exit;
            } else {
                // Handle case where the update did not affect any rows
                echo "No rows were updated.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>



    <div id="main">
        <div id="profile-container">

            <?php
            // Check if $userData is valid before accessing its elements
            if ($userData !== false) {

                // Check if the user has a profile picture
                if (!empty($userData['profilePhoto'])) {
                    // Output the profile picture as an image
                    echo '<img id="pfp" src="data:image/jpeg;base64,' . base64_encode($userData['profilePhoto']) . '" />';
                } else {
                    // Output a default profile picture if the user does not have one
                    echo '<img id="pfp" src="images/blank-profile-picture.png" />';
                }
            } else {
                echo "User data not found.";
            }
            ?>


            <!-- Populate form fields with user's information -->
            <form id="change-info" method="post"  enctype="multipart/form-data">
            <div class="upload">
            <input type="file" id="img" name="img" accept="image/*" style=
            " background-color: transparent;
                border: none;
                position: relative;
                left: 20%;">
            </div>
           <input type="text" id="username" name="username" 
                value="<?php echo isset($userData['username']) ? $userData['username'] : ''; ?>" placeholder="Username"  style=
            " background-color: transparent;
                border: none;
                position: relative;
                left: 12%;" /> 

                <p id="email-entry">
                    <label><img class="icon" src="images/mail-icon.png" alt="email icon" /></label>
                    <input type="email" name="email" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>" placeholder="Email" />
                </p>
                <p id="date-entry">
                    <label><img class="icon" src="images/calendar-icon.png" alt="calendar icon" /></label>
                    <input type="date" name="dob" value="<?php echo isset($userData['DOB']) ? $userData['DOB'] : ''; ?>" placeholder="Date of Birth" />
                </p>
                <p id="bio">
                    <label> <img src="images/user.png" style="width: 50px; margin-right: 1em; margin-left: 4.2em;"></label>
                    <input type="text" name="bio"  value="<?php echo isset($userData['bio']) ? $userData['bio'] : ''; ?>" placeholder="Bio" />
                </p>
                <input type="submit" value="Done" id="done" />

        </div>
    </div>

</body>

</html>