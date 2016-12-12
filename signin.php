<!DOCTYPE HTML>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rainforest |
      <?php
      echo $title;
        ?></title>
    <link rel="stylesheet" href="style.css"  />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/scriptJQ.js"></script>

    <link rel="icon" type="image/png" href="images/rainforestLogo.png" />

</head>

<body>
    <div class="sign">
<form action="login.php" method="post" class="signForm">

<h2 class="signinH2">  My account </h2>
<hr class="signinHr">

  <fieldset>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" title="example@domain.com" required
    value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } else{ "";} ?>">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" title="Minimum 6 characters" pattern=".{6,}"
     required value="<?php if(isset($_POST['password'])) {  echo $_POST['password']; } else{ "";} ?>">

  </fieldset>
  <button type="submit" class="signinBtn">Sign in</button>
  <p class="signinP">New to Rainforest?</p>
    <hr class="signinHr2">

</form>
<a href="signup.php"><button class="signupBtn">Create your Rainforest account</button></a>
</div>
<?php

require 'footer.php';

?>
