<?php

session_start();

error_reporting(E_ALL); 
ini_set('display_errors', 1);

// Include your database connection file
require_once 'server/configure.php';

$user_id = $_SESSION['id']; // Set user ID here

// Check if the form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the content field is set and not empty
    if (isset($_POST['content']) && !empty($_POST['content'])) {
        // Sanitize the input data to prevent SQL injection
        $content = $_POST['content'];
        $title = $_POST['title'];
 // Check if a file was uploaded and there were no errors
 if(isset($_FILES['postImage']) && $_FILES['postImage']['error'] === UPLOAD_ERR_OK){
    // Get the temporary path to the uploaded file
    $img_tmp_path = $_FILES['postImage']['tmp_name'];
    
    // Open the file and read its contents
    $img_data = fopen($img_tmp_path, 'rb');
} else {
    echo "No file uploaded or an error occurred during upload.";
}
        // Get the username of the logged-in user
        $stmt = $pdo->prepare("SELECT username FROM USER WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $creator = $row['username'];
        $created_at = date('Y-m-d H:i:s');

        // Prepare and execute the SQL statement to insert the post into the database
        $stmt = $pdo->prepare("INSERT INTO posts (content, creator, creatorId, created_at, title, img) VALUES (:content, :creator,:user_id, :created_at, :title, :img)");
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':creator', $creator, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img_data, PDO::PARAM_LOB);
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
