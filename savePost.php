<?php

// Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     // Redirect the user to the login page if not logged in
//     header("Location: login.php");
//     exit;
// }

// Include your database connection file
require_once 'server/configure.php';

// Check if the form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the content field is set and not empty
    if (isset($_POST['content']) && !empty($_POST['content'])) {
        // Sanitize the input data to prevent SQL injection
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        
        // Get the username of the logged-in user
        $sql = "SELECT username, FROM users WHERE id = $user_id";
        $result = mysqli_query($conn, $sql);



        // Prepare and execute the SQL statement to insert the post into the database
        $sql = "INSERT INTO posts (content, creator) VALUES ('$content', '$creator')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Post saved successfully
            $post_saved = true;
        } else {
            // Error occurred while saving the post
            $post_saved = false;
        }
    } else {
        // Content field is empty
        $error_message = "Error: Post content cannot be empty.";
    }
} else {
    // Form data not submitted via POST method
    $error_message = "Error: Form data not submitted.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Saved</title>
    <link rel="stylesheet" href="css/success.css">
</head>
<body>
    <?php if (isset($post_saved) && $post_saved) : ?>
    <div class="success-message">
        <h2>Your post has been saved successfully!</h2>
        <p>Thank you for sharing your thoughts.</p>
        
        <a href="profile.php">Back to Profile</a>
    </div>
    <?php elseif (isset($error_message)) : ?>
    <div class="error-message">
        <h2>Error</h2>
        <p><?php echo $error_message; ?></p>
        <a href="profile.php">Back to Profile</a>
    </div>
    <?php endif; ?>
</body>
</html>

