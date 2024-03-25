<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        <?php include "css/reset.css" ?>
    </style>
    <style>
        <?php include "css/home.css";
        include "css/highlight.css";
        include "css/search.css" ;
        include "css/discussion.css";?>
    </style>

    <!-- Load jQuery from CDN or local file -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="script/home.js"></script>
    <link rel="stylesheet" href="css/status.css" />
    <script src="script/home.js"></script>
    <title>Ziki</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/discussion.css">
    <script src="script/discussion.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php include "pageheader.php" ?>
    </div>
    <div id="cards">
            
        </div>
    <script>
        const showCards = document.getElementById("cards");
        const discussions = ["Discussion 1", "Discussion 2", "Discussion 3", "Discussion 4"];
        showCards.innerHTML = discussions.map((e) => {
            return `<div class="card text-center">
                          <div class="card-header">
                            <img id="discussionPFP" class="icons" src="images/blank-profile-picture.png" alt ="disussion pfp">
                            Username 
                            <div class="dropdown">
                            <img id="discDropdown" class="icons" src="images/dropdown.png" alt="dropdown discussion" data-bs-toggle="dropdown" aria-expanded="false">
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Flag</a></li>
                              <li><a class="dropdown-item" href="#">Save</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                            </ul>
                            </div>
                            <img id="discFav" src="images/star.png" alt="favorite discussion">
                           
                          </div>
                            <div class="card-body">
                                <h5 class="card-title">${e}</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" onclick="openDiscussion('${e}')">Comments</button>
                                <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasBottomLabel">${e}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body small" id="discomments">
                                        ...
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary">
                                2 days ago
                            </div>
                        </div>`;
        }).join("");

        function openDiscussion(e) {
            //let discTitle = e;
            //using the name of the discussion, generate related content
            const displayComments = document.getElementById("discomments");
            const comments = ["Comment 1", "Comment 2", "Comment 3", "Comment 4"];
            displayComments.innerHTML = comments.map((e) => {
                return `<div id="individualComment">
                      <img src="images/blank-profile-picture.png" alt="blank pfp" id="commentPFP">
                      ${e}
                      </div><br/>`;
            }).join("");
        }

        function handleLiked(e) {

        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>