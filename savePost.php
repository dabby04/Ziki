<?php

session_start();
// Include your database connection file
require_once 'server/configure.php';

error_reporting(E_ALL); 
ini_set('display_errors', 1);

// Check if the session variable 'id' is set
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id']; // Set user ID here


    // Check if the form data has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the content field is set and not empty
        if (isset($_POST['content']) && !empty($_POST['content'])) {
            // Sanitize the input data to prevent SQL injection
            $content = $_POST['content'];
            $title = $_POST['title'];
            $theme = $_POST['postTheme'];
            
            // Check if a file was uploaded and there were no errors
            if(isset($_FILES['postImage']) && $_FILES['postImage']['error'] === UPLOAD_ERR_OK){
                // Get the temporary path to the uploaded file
                $img_tmp_path = $_FILES['postImage']['tmp_name'];
                
                // Open the file and read its contents
                $img_data = fopen($img_tmp_path, 'rb');
            } else {
                $error_message = "No file uploaded or an error occurred during upload.";
            }

            // Get the username of the logged-in user
            $stmt = $pdo->prepare("SELECT username FROM USER WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $creator = $row['username'];
            $created_at = date('Y-m-d H:i:s');

            // Prepare and execute the SQL statement to insert the post into the database
            $stmt = $pdo->prepare("INSERT INTO POSTS (content, creator, creatorId, created_at, title, img, theme) VALUES (:content, :creator,:user_id, :created_at, :title, :img, :theme)");
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':creator', $creator, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':img', $img_data, PDO::PARAM_LOB);
            $stmt->bindParam(':theme', $theme , PDO::PARAM_STR);
            
            // Execute the SQL statement and handle errors
            if ($stmt->execute()) {
                // Post saved successfully
                $post_saved = true;
            } else {
                // Error occurred while saving the post
                $post_saved = false;
                $error_message = "Error: Unable to save the post.";
            }
        } else {
            // Content field is empty
            $error_message = "Error: Post content cannot be empty.";
        }
    } else {
        // Form data not submitted via POST method
        $error_message = "Error: Form data not submitted.";
    }
} else {
    // Session variable 'id' not set
    $error_message = "Error: User ID not found in session.";
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
