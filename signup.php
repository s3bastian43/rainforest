<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rainforest | Sign up</title>
    <link rel="stylesheet" href="style.css"  />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/scriptJQ.js"></script>
    <link rel="icon" type="image/png" href="images/rainforestLogo.png" />

</head>

<body>
  <div class="sign">
  <form action="signup.php" onSubmit="return validate()" method="post" class="signForm">

  <h2 class="modalH2">  Sign Up </h2>
  <hr class="modalHr">

    <fieldset>
      <label for="firstname">Firstname:</label>
      <input type="text" id="firstname" name="firstname" aria-describedby="name-format" required aria-required=”true” pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{2,50}$"
       title="Your first name. Minimum 2 characters" value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; } else{ "";} ?>">

      <label for="lastname">Lastname:</label>
      <input type="text" id="lastname" name="lastname" aria-describedby="name-format" required aria-required=”true” pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{2,50}$"
      title="Your last name. Minimum 2 characters" value="<?php if(isset($_POST['lastname'])) {  echo $_POST['lastname']; } else{ "";} ?>">

      <section class="middleInfo">
        <div class="left">
      <label for="gender">Gender:</label>
      <input type="radio" name="gender" value="male" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'male') { echo ' checked="checked"'; } ?> > Male<br/>
      <input type="radio" name="gender" value="female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'female') { echo ' checked="checked"'; } ?> > Female<br/>
      <input type="radio" name="gender" value="other" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'other') { echo ' checked="checked"'; } ?> id="other"> Other <br/>
    </div>
        <div class="right">
        <label for="phone">Phone number:</label>
        <input type="tel" name="phone" pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$"
        value="<?php if(isset($_POST['phone'])) { echo $_POST['phone']; } else{ "";} ?>" title="Please use UK format only">
        </div>
    </section>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" title="example@domain.com" required value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } else{ "";} ?>">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" title="Minimum 6 characters" pattern=".{6,}"
       required value="<?php if(isset($_POST['password'])) {  echo $_POST['password']; } else{ "";} ?>">

      <label for="password">Confirm password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required><span id='message'></span>

      <label for="birthday">Birthday</label>
        <input type="date" name="birthday" value="<?php if(isset($_POST['birthday'])) { echo $_POST['birthday']; } else{ "";} ?>">
    </fieldset>
    <button type="submit" class="signupBtn2">Create you Rainforest account</button>

  </form>
</div>

<?php

require 'footer.php';

require 'mysql.php';

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) ){
  if($_POST['password'] == $_POST['confirm_password']){


$stmt = $pdo->prepare('INSERT INTO user (firstname, lastname, email, dob, password, gender, phone) VALUES(:firstname, :lastname, :email, :dob, :password, :gender, :phone)' );
$stmtEmail = $pdo->prepare('SELECT email FROM user WHERE email=:email');

$criteriaEmail = [
  'email' => $_POST['email']
];

$stmtEmail -> execute($criteriaEmail);
foreach ($stmtEmail as $row) {
$row['email'];
}
if($row['email'] == $_POST['email']){
  echo  '<script type="text/javascript">
 window.alert("Sorry, it seems that the email address you have entered is already registered on Rainforest");
 </script>';
}
else{
$criteria = [
  'firstname' => $_POST['firstname'],
  'lastname' => $_POST['lastname'],
  'email' => $_POST['email'],
  'dob' => $_POST['birthday'],
  'password' => $hash = password_hash($_POST['password'], PASSWORD_DEFAULT),
  'gender' => $_POST['gender'],
  'phone' => $_POST['phone']

];

$stmt->execute($criteria);
 echo  '<script type="text/javascript">
window.alert("Your account has been successfully created");
window.location.href="index.php";
</script>';
exit;
}
}
}
 ?>
