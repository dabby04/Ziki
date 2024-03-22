<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/highlight.css" />
  <script type="text/javascript" src="script/login.js"></script>
</head>

<body>
  <header class="header">
    <h1 class="title"><a href="home.html">Ziki</a></h1>
    <h6 class="subtitle">A place where gen Z can connect</h6>
  </header>
  <form id="form" action="#">
    <div class="input-container">
      <label for="username">Username</label>
      <input type="text" id="username" class="input-field" aria-label="Username" name="username" ,
        placeholder="Username" />
    </div>
    <div class="input-container">
      <label for="password">Password</label>
      <input type="password" id="password" class="input-field" aria-label="Password" name="password" ,
        placeholder="Password" />
    </div>
    <div class="content">

      <div class="registration-link">
        <a href="registration.html">Register here</a>
      </div>
      <button class="button" type="submit">Lets gooo</button>
  </form>
    <!-- after form validation, use: $_SESSION['login']=true; -->
</body>

</html>