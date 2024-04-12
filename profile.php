
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'server/configure.php';

session_start();

if (!(isset($_SESSION['id']))) {
    header("Location: login.php");
    exit;
}else if ($_SESSION['status'] === "admin") {
    header("Location: admin.php");
    exit;
}else { 
    
    $user_id = $_SESSION['id'];
error_log("User ID: " . $user_id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style><?php 
    include "css/reset.css";
    include "css/profile.css";
    include "pageheader.php";
    ?>
    </style>
    <!-- <link rel="stylesheet" href="css/pageheader.css" />
    <link rel="stylesheet" href="css/profile.css?v=<?php echo time(); ?>"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="script/profile.js"></script>
</head>


<?php
try {
    
    $sql = "SELECT * FROM USER WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $userData['username'];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<body>
<header class="profile_header">
    <?php if (!empty($userData['profilePhoto'])): ?>
        <img id="header-img" src="images/headerimg.png" />
        <img class="pfpp" src="data:image/jpeg;base64,<?php echo base64_encode($userData['profilePhoto']); ?>"  />
    <?php else: ?>
        <img id="header-img" src="images/headerimg.png" />
        <img class="pfpp" src="images/blank-profile-picture.png"  />
    <?php endif; ?>
    
    <!-- Post Popup Form -->
<!-- Post Popup Form -->
<div id="postPopup" class="popup">
    <form id="postForm" action="savePost.php" method="post" enctype="multipart/form-data">
        <textarea name="content" placeholder="Speak your mind..."></textarea>
        <input type="text" name="title" placeholder="Enter title" id="postTitle">
        <div class="inputControls">
            <label for="postImage">
                <img id="photo_icon" src="images/photo_icon.png" alt="Photo Icon"/>
            </label>
            <input type="file" id="postImage" name="postImage" accept="image/*"required>

              <!-- Themes Option -->
              <label for="postTheme">Select a theme:</label>
            <select name="postTheme" id="postTheme">
                <option value="Technology">Technology</option>
                <option value="Travel">Travel</option>
                <option value="Food">Food</option>
                <option value="Art">Art</option>
                <option value="Sports">Sports</option>
                <option value="Other">Other</option>
       
            </select>
            
            
            <button type="button" class="postButtons" id="XButton" onclick="closePostPopup()">X</button>
            <button type="submit" class="postButtons">Submit</button>
        </div>
    </form>
</div>

</header>


    <div class="profile-info">
        <p id="username">@<?php echo $userData['username']; ?></p>
        <?php
        if ($userData['DOB']) {
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

    <?php if (!isset($_GET['id'])): ?>
    <section class="button-container">
        <a href="editprofile.php"><button class="rounded-button"> Edit Profile</button></a>
        <button class="rounded-button" onclick="makeAPost()">Make a Post</button>
    </section>
    <?php endif; ?>



    <nav id="tab-tool">
    <div class="text-option" id="viewMain">Posts</a></div> 
    <div class="text-option" id="viewComments">Commented</a></div>
    <div class="text-option" id="viewLiked" > Favourites </div>
    </nav>


<?php  
    
// Connect to the database

    // Query to select posts
    try {
        // Query to select posts
        $sql = "SELECT *
                FROM POSTS p
                JOIN USER u ON p.creatorId = u.id
                WHERE p.creatorId = ?
                ORDER BY p.created_at DESC"; 
    
        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Fetch all rows as an associative array
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    } catch (PDOException $e) {
        // Handle database connection error
        echo "Error: " . $e->getMessage();
    }
    
?>


<section id ="main-posts">
<?php foreach ($posts as $post): ?>

    <div class="post-section">
        <div class="post-container">
            <!-- User profile photo in top right -->
            <?php if (!empty($post['profilePhoto'])): ?>
                <img class="profile-photo" src="data:image/jpeg;base64,<?php echo base64_encode($post['profilePhoto']); ?>" alt="User Profile Photo">
            <?php endif; ?>
            <!-- Post title in center -->
            <h2 class="post-title"><?php echo $post['title']; ?></h2>

            <p id="post username"> @  <?php echo $username ?> Says </p>

            <!-- Post content in middle -->
            <p class="post-content"><?php echo $post['content']; ?></p>
             <!-- Display post image -->
             <?php if (!empty($post['img'])): ?>
                <?php
                // Decode the base64 encoded image
                $imageData = base64_encode($post['img']);
                // Format the image source
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                ?>
                <img class="post-image" src="<?php echo $imageSrc; ?>" alt="Post Image">
            <?php endif; ?>
            <form id="submitDiscussion" action="viewDiscussion.php" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="discussion_title" value="<?php echo $post['title']; ?>">
            <button class="view-comment-button" type="submit">View Discussion</button>
            <!-- Post footer displaying the time the post was made -->
            <div class="post-footer"><?php echo date("F j, Y, g:i a", strtotime($post['created_at'])); ?></div>
        </div>
    </div>
           
<?php endforeach; ?>

</section>



<section id="liked-posts">
<?php
try {
    // Query to select liked posts
    $sql2 = "SELECT p.id, p.title, p.content,p.creator, p.creatorId, p.created_at, p.img, u.profilePhoto
    FROM POSTS p
    INNER JOIN COMMENTS c ON p.id = c.postId
    INNER JOIN USER u ON p.creatorId = u.id
    WHERE c.userId = ?
    ORDER BY p.created_at DESC;
    ";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql2);
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all rows as an associative array
    $likedPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Display liked posts
    foreach ($likedPosts as $post) {
        // Output the HTML for each post
        ?>
        <div class="post-section">
        <div class="post-container">
            <!-- User profile photo in top right -->
            <?php if (!empty($post['profilePhoto'])): ?>
                <img class="profile-photo" src="data:image/jpeg;base64,<?php echo base64_encode($post['profilePhoto']); ?>" alt="User Profile Photo">
            <?php endif; ?>
            <!-- Post title in center -->
            <h2 class="post-title"><?php echo $post['title']; ?></h2>

            <p id="post username"> @  <?php echo $post['creator']?> Says </p>

            <!-- Post content in middle -->
            <p class="post-content"><?php echo $post['content']; ?></p>
             <!-- Display post image -->
             <?php if (!empty($post['img'])): ?>
                <?php
                // Decode the base64 encoded image
                $imageData = base64_encode($post['img']);
                // Format the image source
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                ?>
                <img class="post-image" src="<?php echo $imageSrc; ?>" alt="Post Image">
            <?php endif; ?>

            <!-- View comment button -->
            <button class="view-comment-button">View Discussion</button>
            <!-- Post footer displaying the time the post was made -->
            <div class="post-footer"><?php echo date("F j, Y, g:i a", strtotime($post['created_at'])); ?></div>
        </div>
        </div>
        <?php
    }

} catch (PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
}
?>

</section>


<section id="commented-posts">
<?php
try {
    // Query to select liked posts
    $sql2 = "SELECT p.title, p.content, p.creatorId, p.creator, p.created_at, p.img, u.profilePhoto
            FROM POSTS p
            JOIN FAVOURITES f ON p.id = f.postId
            JOIN USER u ON p.creatorId = u.id
            WHERE f.userId = ? 
            ORDER BY p.created_at DESC";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql2);
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all rows as an associative array
    $commentPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Display liked posts
    foreach ($commentPosts as $post) {
        // Output the HTML for each post
        ?>
        <div class="post-section">
        <div class="post-container">
            <!-- User profile photo in top right -->
            <?php if (!empty($post['profilePhoto'])): ?>
                <img class="profile-photo" src="data:image/jpeg;base64,<?php echo base64_encode($post['profilePhoto']); ?>" alt="User Profile Photo">
            <?php endif; ?>
            <!-- Post title in center -->
            <h2 class="post-title"><?php echo $post['title']; ?></h2>

            <p id="post username"> @  <?php echo $post['creator']?> Says </p>

            <!-- Post content in middle -->
            <p class="post-content"><?php echo $post['content']; ?></p>
             <!-- Display post image -->
             <?php if (!empty($post['img'])): ?>
                <?php
                // Decode the base64 encoded image
                $imageData = base64_encode($post['img']);
                // Format the image source
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                ?>
                <img class="post-image" src="<?php echo $imageSrc; ?>" alt="Post Image">
            <?php endif; ?>
            <!-- View comment button -->
            <button class="view-comment-button">View Discussion</button>
            <!-- Post footer displaying the time the post was made -->
            <div class="post-footer"><?php echo date("F j, Y, g:i a", strtotime($post['created_at'])); ?></div>
        </div>
        </div>
        <?php
    }

} catch (PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
}
?>

</section>

            </body>
        </html>