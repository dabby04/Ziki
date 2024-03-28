<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', 1);
require_once 'server/configure.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['section'])) {
    // Get the user ID from the session or any other way you're identifying the user
    $user_id = $_SESSION['user_id'];

    // Connect to the database using PDO
    try {
        $pdo = new PDO("mysql:host=$DBHOST;dbname=$DBNAME;charset=utf8mb4", $DBUSER, $DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch posts based on the selected section
        $section = $_POST['section'];
        $sql = '';
        switch ($section) {
            case 'posts':
                $sql = "SELECT * FROM posts WHERE creator = :user_id";
                break;
            case 'discussions':
                // Fetch discussions based on user's comments on posts
                $sql = "SELECT p.* FROM posts p INNER JOIN comments c ON p.id = c.postId WHERE c.userId = :user_id";
                break;
            case 'likes':
                // Fetch liked posts based on user's interactions
                $sql = "SELECT p.* FROM posts p INNER JOIN likes l ON p.id = l.postId WHERE l.userId = :user_id";
                break;
            case 'favorites':
                // Fetch favorite posts based on user's interactions
                $sql = "SELECT p.* FROM posts p INNER JOIN favorites f ON p.id = f.postId WHERE f.userId = :user_id";
                break;
            default:
                // Invalid section
                echo "Invalid section";
                exit();
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display fetched posts
        foreach ($posts as $post) {
            // Output each post as HTML
            echo '<div class="post">';
            echo '<h2>' . $post['title'] . '</h2>';
            echo '<p>' . $post['content'] . '</p>';
         
            echo '</div>';
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Invalid request
    echo "Invalid request";
}
?>
