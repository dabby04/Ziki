<!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Profile </title>
     <link rel="stylesheet" href="css/pageheader.css" />
     <link rel="stylesheet" href="css/profile.css?v=<?php echo time(); ?>">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="script/profile.js"></script>
 </head>

 <body>


 <?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);

 session_start();
 require_once 'server/configure.php';

 if (!isset($_SESSION['id'])) {
     header("Location: login.php");
     exit;
 }

 if ($_SESSION['status'] === "admin") {
     header("Location: admin.php");
     exit;
 }

 $user_id = $_SESSION['id'];

 try {

     $sql = "SELECT * FROM USER WHERE id = :user_id";
     $stmt = $pdo->prepare($sql);
     $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
     $stmt->execute();
     $userData = $stmt->fetch(PDO::FETCH_ASSOC);

 } catch (PDOException $e) {
     echo "Error: " . $e->getMessage();
 }
 ?>



 <header class="header">
     <h1 class="title"><a href="home.php">Ziki</a></h1>
     <?php if (!empty($userData['profilePhoto'])): ?>
         <img id="header-img" src="images/headerimg.png" />
         <img class="pfp" src="data:image/jpeg;base64,<?php echo base64_encode($userData['profilePhoto']); ?>"  />
     <?php else: ?>
         <img id="header-img" src="images/headerimg.png" />
         <img class="pfp" src="images/blank-profile-picture.png"  />
     <?php endif; ?>

     <!-- Post Popup Form -->
     <div id="postPopup" class="popup">
         <form id="postForm" action="savePost.php" method="post" enctype="multipart/form-data">
             <textarea name="content" placeholder="Speak your mind..."></textarea>
             <div class="inputControls">
                 <input type="text" name="title" placeholder="Enter title" id="postTitle">
                 <button type="button" class="postButtons" id="XButton" onclick="closePostPopup()">X</button>
                 <label for="postImage">
                     <img id="photo_icon" src="images/photo_icon.png" alt="Photo Icon"/>
                 </label>
                 <input type="file" id="postImage" name="postImage" accept="image/*">
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
     <div class="text-option" ><a href="profile.php">Posts</a></div> 
     <div class="text-option" id="last" onclick="toggle('commentedPosts.php')" ><a href=""></a></div>
     <div class="text-option" onclick="toggle('likedPosts.php')"><a href="likedPosts.php">Favorites</a></div>


 <?php
 // Include database configuration
 require_once 'server/configure.php';

 try {

     // Query to select liked posts
     $sql = "SELECT p.title, p.content, p.created_at, u.profilePhoto
             FROM POSTS p
             INNER JOIN FAVOURITES f ON p.id = f.postId
             INNER JOIN USER u ON p.creatorId = u.id
             WHERE f.userId = :userId
             ORDER BY p.created_at DESC";

     // Prepare and execute the query
     $stmt = $pdo->prepare($sql);
     $stmt->bindParam(':userId', $_SESSION['id'], PDO::PARAM_INT);
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
                 <!-- Post content in middle -->
                 <p class="post-content"><?php echo $post['content']; ?></p>
                 <button class="view-comment-button">View Comments</button>
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

 </body>

 </html>