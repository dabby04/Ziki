<!DOCTYPE html>
<html>

<head>
  <style>
    <?php include_once "css/reset.css"; ?>
  </style>
  <style>
    <?php include_once "css/login.css"; ?>
    <?php include_once "css/registration.css"; ?>
    <?php include_once "css/highlight.css"; ?>
  </style>
  <script type="text/javascript" src="script/registration.js"></script>
</head>

<body>
  <header class="header">
    <div class="home">
      <h1 class="title"><a href="home.php">Ziki</a></h1>
    </div>
    <div class="login">
      <a href="login.php">Login</a>
    </div>
  </header>

  <form id="registration" action="storeRegistration.php" method="post"  enctype="multipart/form-data">
    <div class="input-container">
      <input type="text" id="name" class="input-field" aria-label="Full Name" name="name" placeholder="Full Name" />
    </div>
    <div class="input-container">
      <input type="email" id="email" class="input-field" aria-label="Email" name=email placeholder="Email" />
    </div>
    <div class="input-container">
      <div class="dob_div">
        <label for="dob" id="dob_label">Date of Birth</label>
        <input type="date" id="dob" class="input-field" aria-label="Date of Birth" name="dob"
          placeholder="Date of Birth" />
      </div>
    </div>
    <div class="input-container">
      <input type="text" id="username" class="input-field" aria-label="Username" name="username"
        placeholder="Username" />
    </div>
    <div class="input-container">
      <input type="password" id="password" class="input-field" aria-label="Password" name="password"
        placeholder="Password" />
    </div>
    <div class="input-container">
      <input type="password" id="repeat" class="input-field" aria-label="Password" name="repeat_pass"
        placeholder="Repeat Password" />
    </div>
    <div class="input-container">
      <div id=profile_image style="margin-top: 2em; margin-left: 2em;">
        <label for="img">Upload Profile Photo</label>
        <input type="file" id="img" name="img" accept="image/*">
      </div>
    </div>
    <span id="wrong_pass_alert"></span>
    <div id="button-container">
      <button class="button" type="submit">Register Now!</button>
    </div>
  </form>
</body>