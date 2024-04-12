<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Include your database connection file
    require_once "server/configure.php";

    // Check if the title is provided in the form data
    if (isset($_POST['discussion_title'])) {
        $title = $_POST['discussion_title'];

        $sql = "SELECT id FROM POSTS WHERE title = ?";
        $statement = $pdo->prepare($sql);

        $statement->execute([$title]); 
        $discussionId = $statement->fetchColumn();

        // Check if discussionId is retrieved
        if ($discussionId) {
            header("Location: specificDiscussion.php?discTopic=$discussionId");
            exit;
        } else {
            echo "Error: Discussion not found.";
        }
    } else {
        echo "Error: Discussion title is not provided.";
    }
}
?>
