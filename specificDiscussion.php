<?php
    //include_once 'php/status.php';
    session_start();
    
    $status="";
    $username=null;
    if(isset($_SESSION['status']))
    {
        $status=$_SESSION['status'];
        $username=$_SESSION['username'];
        //$username="something";

    }
    else
        $status="inactive";

        
        $phpArray = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
        $jsArray = json_encode($phpArray);
        
    
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/highlight.css" />
    <link rel="stylesheet" href="css/search.css" />

    <!-- Load jQuery from CDN or local file -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="script/home.js"></script>
    <link rel="stylesheet" href="css/status.css" />
    <link rel="stylesheet" href="css/discussion.css">
    <script src="script/home.js"></script>
</head>

<body>
    <header class="header">
        <div id="header-info">
            <h1 class="title">Ziki</h1>
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
                                <?php
                                    echo "<p>".$username."</p>"
                                    ?>
                            </div>
                            <div class="view"><button>View profile</button></div>
                            <div class="edit"><button>Edit profile</button></div>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </div>
        <div class="search-container" tabindex="1">
            <input type="text" placeholder="Search">
            <a class="button">
                <img src="images/search.png" alt="Search">
            </a>
        </div>
    </header>
    <div id="discomments">
        <!-- <Button onclick=openDiscussion(discomments)> -->
    </div>
    <script>
        var comments = <?php echo $jsArray; ?>;
        function openDiscussion(e)
            {
                //let discTitle = e;
                //using the name of the discussion, generate related content
                const displayComments = document.getElementById("discomments");
                //const comments = ["Comment 1", "Comment 2", "Comment 3", "Comment 4"];
                displayComments.innerHTML= comments.map((e)=>{
                    return `<div id="individualComment">
                      <img src="images/blank-profile-picture.png" alt="blank pfp" id="commentPFP">
                      ${e}
                      </div><br/>`;
                }).join("");
            }
    </script>
</body>

</html>