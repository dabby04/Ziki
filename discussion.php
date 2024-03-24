<?php
    include_once 'php/status.php';
    session_start();

    if(isset($_SESSION['login']))
        $status="active";
    else
        $status="inactive";
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/highlight.css" />
        <link rel="stylesheet" href="css/search.css" />

        <!-- Load jQuery from CDN or local file -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="css/status.css" />
        <script src="script/home.js"></script>
        <title>Ziki</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/discussion.css">
        <script src="script/discussion.js" ></script>
    </head>
    <body>
        <!-- <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Ziki</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                          <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                      </ul>
                    </li>
                  </ul>
                  <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
              </div>
            </div>
          </nav> -->
          <header class="header">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <div>
                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                  </div>
                  <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                      Dropdown button
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div id="header-info">
                <h1 class="title">Ziki</h1>
                <h6 class="subtitle">A place where gen Z can connect</h6>
            </div>
            <div id="user_button">
                <!-- <div class="profile-popup"> <button> <a href="login.html">Login </a></button> <button><a href="registration.html">Registration</a></button> </div> -->
                <button><a href="login.html" id="profile-icon"><img src="images/user.png"></a></button>
                <!-- <button><a href="login.html"><img src="images/user.png"></a></button> -->
                <div class="card">
                    <section class="user_status">
                        <?php if ($status === "inactive"): ?>
                        <div class="inactive">
                            <div class="login_box"><a href="login.html"><button>LOGIN</button></a></div>
                            <div class="signup_box"><a href="registration.html"><button>SIGN UP</button></a></div>
                        </div>
                        <?php elseif ($status === "active"): ?>
                        <div class="active">
                            <div class="profile_info">
                                <img src="images/user.png">
                                <p>Username</p>
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
        <div id="cards">
            
        </div>
        <!-- <script>
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
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" onclick="openDiscussion('${e})">Comments</button>
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

            

            function handleLiked(e)
            {
              
            }

        </script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
