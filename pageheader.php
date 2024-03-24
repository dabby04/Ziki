<?php
include_once 'php/status.php';
session_start();

if (isset ($_SESSION['login']))
    $status = "active";
else
    $status = "inactive";
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        <?php include "css/reset.css"; ?>
    </style>
    <style>
        <?php include "css/pageheader.css"; ?>
        <?php include "css/search.css"; ?>
        <?php include "css/status.css"; ?>
    </style>
    <script src="script/pageheader.js"></script>
</head>

<body>
    <!-- <?php
    include "php/status.php";
    ?> -->
    <header class="header">
        <div id="header-info">
            <h1 class="title"><a href="home.php">Ziki</a></h1>
            <h6 class="subtitle">A place where gen Z can connect</h6>
        </div>
        <div id="user_button">
            <!-- <div class="profile-popup"> <button> <a href="login.html">Login </a></button> <button><a href="registration.html">Registration</a></button> </div> -->
            <button><a href="login.php" id="profile-icon"><img src="images/user.png"></a></button>
            <!-- <button><a href="login.html"><img src="images/user.png"></a></button> -->
            <div class="card">
                <section class="user_status">
                    <?php if ($status === "inactive"): ?>
                        <div class="inactive">
                            <div class="login_box"><a href="login.php"><button>LOGIN</button></a></div>
                            <div class="signup_box"><a href="registration.php"><button>SIGN UP</button></a></div>
                        </div>
                    <?php elseif ($status === "active"): ?>
                        <div class="active">
                            <div class="profile_info">
                                <img src="images/user.png">
                                <?php if (isset ($username)): ?>
                                    <p>$username</p>
                                <?php endif; ?>
                            </div>
                            <div class="view"><button>View profile</button></div>
                            <div class="edit"><button>Edit profile</button></div>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </div>
        <div class="search-container" tabindex="1">
            <form action="php/search.php" method="get">
                <input type="text" placeholder="Search" name="query">
                <a class="button">
                    <img src="images/search.png" alt="Search">
                </a>
            </form>
        </div>
    </header>

</body>

</html>