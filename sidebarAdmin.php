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
</head>

<body>
  <div class="logo">
    <img src="images/bar.png" alt="">
  </div>

  <nav>
            <div class="navbar">
            <ul>
                <li><a href="#">
                  <i class="fas fa-user"></i>
                  <span class="nav-item">Dashboard</span>
                </a>
                </li>
                <li><a href="#">
                    <i class="fas fa-search"></i>
                  <span class="nav-item">Search User</span>
                </a>
                </li>
                <li><a href="#">
                  <i class="fas fa-tasks"></i>
                  <span class="nav-item">Post Management</span>
                </a>
                </li>
                <li><a href="#" class="logout">
                  <i class="fas fa-sign-out-alt"></i>
                  <span class="nav-item">Logout</span>
                </a>
                </li>
              </ul>
            </div>
          </nav> 
</body>

</html>