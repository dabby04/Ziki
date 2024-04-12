<!DOCTYPE html>
<html>

<head>
  <?php include "pageheader.php" ?>
  <style>
    <?php include "css/sidebarAdmin.css";
    include '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />';
    ?>
  </style>
  <link rel="stylesheet" href="css/sidebarAdmin.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="script/sidebarAdmin.js"></script>
</head>

<body>
  <div class="logo">
    <img src="images/bar.png" alt="">
  </div>

  <nav>
            <div class="navbar">
            <ul>
                <li><a href="admin.php" class="navlinks">
                  <i class="fas fa-user"></i>
                  <span class="nav-item">Dashboard</span>
                </a>
                </li>
                <li><a href="searchUser.php" class="navlinks">
                    <i class="fas fa-search"></i>
                  <span class="nav-item">Search User</span>
                </a>
                </li>
                <li><a href="postMan.php" class="navlinks">
                  <i class="fas fa-tasks"></i>
                  <span class="nav-item">Post Management</span>
                </a>
                </li>
                <li><a href="php/logout.php" class="logout_sidebar" >
                  <i class="fas fa-sign-out-alt"></i>
                  <span class="nav-item">Logout</span>
                </a>
                </li>
              </ul>
            </div>
          </nav> 
</body>

</html>