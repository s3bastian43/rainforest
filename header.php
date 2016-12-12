<?php
if(!isset($_SESSION))
{
    session_start();
}

if (isset($_SESSION['loggedin'])) {
   include('session.php');
   echo  '<script type="text/javascript">
   var loggedin = true;
  </script>';
 }

require 'mysql.php';

$stmtMenu = $pdo->prepare('SELECT * FROM categories');
$stmtMenu2 = $pdo->prepare('SELECT * FROM subcategories WHERE category_id = :category_id');
$stmtMenu->execute();



 ?>

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

    <header>
      <div class="centerHeader">
        <a href="index.php" class="top">
        <h1 class="title">Rainforest</h1>
        </a>
<form class="search">
  <input type="text" name="search" placeholder="Search for a product">
</form>
<div class="myaccount">
  <a href="signin.php" class="top" id="account">
  <img src="images/account.png" class="topIco" alt"Account icon" height="36px" width="36px">
  <p class='headerP'>My account</p>
</a>
<div class="accountOpt">
  <a href="profile.php"><button class="profile">View profile</button></a>
  <a href="logout.php"><button class="logout">Log out</button></a>
</div>
</div>
    <p class="username"><?php echo $hello . $user_firstname; ?></p>

  <a href="#" class="top">
  <img src="images/favorite.png" class="topIco" alt"Favorite icon" height="36px" width="36px">
  <p class='headerP'>Favorites</p>
  </a>

  <a href="#" class="top">
  <img src="images/basket.png" class="topIco" alt"Basket icon" height="36px" width="36px">
  <p class='headerP'>My basket</p>
  </a>
</div>
<ul class="navigation">
  <li><a href="index.php">Home</a></li>
  <?php
  while($category = $stmtMenu->fetch()){
    echo '<li><a href="http://v.je/product.php?category=' . $category['category_id'] . '">' . $category['category_name'] . '</a>';
    echo '<ul>';
    $criteriaSubCat = [
      'category_id' =>  $category['category_id']
    ];

    $stmtMenu2->execute($criteriaSubCat);
    while($subcategory = $stmtMenu2->fetch()){

    echo '<li><a href="http://v.je/productSC.php?subcategory=' . $subcategory['subcategory_id'] . '">' . $subcategory['subcategory_name'] . '</a></li>';
    }
    echo '</ul></li>' ;
  }
  ?>
</ul>

        <!--      <input type="text" name="search" placeholder="Search.."> -->
    </header>
