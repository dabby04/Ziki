<?php
    include_once 'php/status.php';
    session_start();

    if(isset($_SESSION['login']))
        $status="active";
    else
        $status="inactive";
    
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
    <script src="script/home.js"></script>
</head>

<body>
    <?php
    // include "php/status.php";
    include "pageheader.php";
    ?>
    
    <div id="top2">
        <div id="centre_top2">
            <figure>
                <img src="images/hamilton.png">
                <figcaption>Lewis Hamilton signs with Ferrari</figcaption>
            </figure>
        </div>
        <div id="centre_top2">
            <figure>
                <img src="images/smith.png">
                <figcaption>What do you think?</figcaption>
            </figure>
        </div>
    </div>
    <div id="trending">
        <div class="box">
            <h3>Trending Discussions</h3>
            <div class="discuss">
                <figure>
                    <img src="images/question.png">
                    <figcaption>It's so easy to find a job, don't you think?</figcaption>
                </figure>
            </div>
            <div class="discuss">
                <figure>
                    <img src="images/bellingham.png">
                    <figcaption>Jude Bellingham might be the next best player...</figcaption>
                </figure>
            </div>
            <div class="discuss">
                <figure>
                    <img src="images/laptop.png">
                    <figcaption>What are your favourite reboots?</figcaption>
                </figure>
            </div>
            <div class="discuss">
                <figure>
                    <img src="images/tech.png">
                    <figcaption>How do I break into tech?</figcaption>
                </figure>
            </div>
            <div class="discuss">
                <a href="#">
                    <h3>Show more discussions</h3>
                </a>
            </div>
        </div>
    </div>

    <div id="posts">
        <nav>
            <div class="toggle-container">
                <ul>
                    <div class="toggle-box">
                        <li id="home" class="picks"><a href="#">Hot tea</a></li>
                    </div>
                    <div class="toggle-box">
                        <li id="favourites" class="picks"><a href="#">Favourites</a></li>
                    </div>
                    <div class="toggle-box">
                        <li id="top_comments" class="picks"><a href="#">Top comments</a></li>
                    </div>
                    <div class="toggle-box">
                        <li id="explore" class="picks"><a href="#">Explore</a></li>
                    </div>

                    <!-- <li id="home" class="picks"><a href="#">Hot tea</a></li> |
                <li id="favourites" class="picks"><a href="#">Favourites</a></li> |
                <li id="top_comments" class="picks"><a href="#">Top comments</a></li>|
                <li id="explore" class="picks"><a href="#">Explore</a></li> -->
                </ul>
            </div>

        </nav>
        <div id="contentBox">
        </div>
    </div>

</body>

</html>