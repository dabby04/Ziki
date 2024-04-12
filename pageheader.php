<?php
//include_once 'php/status.php';
session_start();

$status = "";
$username = null;
$profile_photo = null;
try {
    require_once "server/configure.php";
    if (isset($_SESSION['status'])) {
        $status = $_SESSION['status'];
        $username = $_SESSION['username'];

        $sql = "SELECT * FROM USER WHERE username = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$username]);

        if ($statement->rowCount() === 0) {
            
            $status="active";

        } else {
            $sql = "SELECT profilePhoto FROM USER WHERE username = ?";
            $statement = $pdo->prepare($sql);
            $statement->execute([$username]);
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $profile_photo = $row['profilePhoto'];
        }
    } else
        $status = "inactive";
} catch (PDOException $e) {
    die($e->getMessage());
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        <?php include "css/reset.css"; ?>
    </style>
    <style>
        <?php include "css/pageheader.css"; ?>
        <?php include "css/search.css"; ?>
        <?php include "css/status.css"; ?>
        <?php include "css/discussion.css"; ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="script/page.js"></script>
    <script src="script/pageheader.js"></script>
</head>

<body>

    <?php
    //include "php/status.php";
    ?>
    <div class="wrapper">
        <header class="header">
            <div id="header-info">
                <h1 class="title"><a href="home.php">Ziki</a></h1>
                <h6 class="subtitle">A place where gen Z can connect</h6>
            </div>
            <div id="user_button">
                <!-- <div class="profile-popup"> <button> <a href="login.html">Login </a></button> <button><a href="registration.html">Registration</a></button> </div> -->
                <button><a href="login.php" id="profile-icon"><img src="images/user.png"></a></button>
                <!-- <button><a href="login.html"><img src="images/user.png"></a></button> -->
                <div class="statcard">
                    <section class="user_status">
                        <?php if ($status === "inactive"): ?>
                            <div class="inactive">
                                <div class="login_box"><a href="login.php"><button>LOGIN</button></a></div>
                                <div class="signup_box"><a href="registration.php"><button>SIGN UP</button></a></div>
                            </div>
                        <?php elseif ($status === "active"): ?>
                            <div class="active">
                                <div class="profile_info">
                                    <?php if ($profile_photo):
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($profile_photo) . '" />'; ?>
                                    <?php else: ?>
                                        <img src="images/user.png">
                                    <?php endif; ?>
                                    <?php if (isset($username)):
                                        echo "<p>" . $username . "</p>" ?>
                                    <?php endif; ?>
                                </div>
                                <div class="view"><button>View profile</button></div>
                                <div class="logout"><a href="php/logout.php"><button>Logout</button></a></div>
                            </div>
                        <?php endif; ?>
                    </section>
                </div>
            </div>
            <div class="search-container" tabindex="1">
                <form action="discussion.php" method="get">
                    <input type="text" placeholder="Search" name="query">
                    <a class="button">
                        <img src="images/search.png" alt="Search">
                    </a>
                </form>
            </div>
        </header>
    </div>

</body>

</html>