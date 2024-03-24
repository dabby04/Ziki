<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1);

// Include your database connection file
require_once 'server/configure.php';

// Check if the form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the content field is set and not empty
    if (isset($_POST['content']) && !empty($_POST['content'])) {
        // Sanitize the input data to prevent SQL injection
        $content = $_POST['content'];
        $title = $_POST['title'];
        $user_id = 1; // Set user ID here
        // $user_id = $[Session]; // Set user ID here
        $img = null;
        if(isset($_POST['postImage'])){
            $img = file_get_contents($_FILES['postImage']['tmp_name']);
        }
        // Get the username of the logged-in user
        $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $creator = $row['username'];
        $created_at = date('Y-m-d H:i:s');

        // Prepare and execute the SQL statement to insert the post into the database
        $stmt = $pdo->prepare("INSERT INTO posts (content, creator, created_at, title, img) VALUES (:content, :user_id, :created_at, :title, :img)");
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':img', $title, PDO::PARAM_LOB);
        $result = $stmt->execute();

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
