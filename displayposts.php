DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Profile</title>
     <link rel="stylesheet" href="css/pageheader.css" />
     <link rel="stylesheet" href="css/profile.css?v=<?php echo time(); ?>">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 </head>

 <?php
 // Include database configuration
 require_once 'server/configure.php';

 try {

     // Query to select posts
     $sql = "SELECT p.title, p.content, p.created_at, u.profilePhoto
             FROM POSTS p
             INNER JOIN USER u ON p.creatorId = u.id
             ORDER BY p.created_at DESC"; // Change the ORDER BY clause as needed`

     // Prepare and execute the query
     $stmt = $pdo->query($sql);

     // Fetch all rows as an associative array
     $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

 } catch (PDOException $e) {
     // Handle database connection error
     echo "Error: " . $e->getMessage();
 }
 ?>

 <body>

 <?php foreach ($posts as $post): ?>
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
             <!-- View comment button -->
             <button class="view-comment-button">View Comments</button>
             <!-- Post footer displaying the time the post was made -->
             <div class="post-footer"><?php echo date("F j, Y, g:i a", strtotime($post['created_at'])); ?></div>
         </div>
     </div>
 <?php endforeach; ?>



 </body>

 </html>