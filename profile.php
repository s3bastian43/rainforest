<?php
$title = 'Profile';

include('session.php');
require 'header.php';

if (isset($_SESSION['administrator'])) {
   header("Location: administrator.php");
 }
if (!isset($_SESSION['login_user'])) {
   header("Location: signin.php");
   exit();
}
 ?>
Sal
<b id="logout"><a href="logout.php">Log Out</a></b>
 <?php

require 'footer.php';

  ?>
