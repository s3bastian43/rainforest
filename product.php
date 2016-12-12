<?php
$title = $_GET['category'];
$hello = '';
$user_firstname = '';

require 'header.php';

$stmtGetCategory = $pdo->prepare('SELECT * FROM products WHERE category_id = :category_id');


$criteriaCat = [
  'category_id' =>  $_GET['category']
];

$stmtGetCategory -> execute($criteriaCat);

 ?>

  <div class="product">
    <img src="/images/laptop.jpg" class="productImg">
    <div class="productTitle">
      HP Spectre x360
    </div>
    <div class="productContent">

    £999
  </div>
  </div>
