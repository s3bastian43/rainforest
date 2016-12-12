<?php
$title = $_GET['subcategory'];
$hello = '';
$user_firstname = '';

require 'header.php';

$stmtGetSubcategory = $pdo->prepare('SELECT * FROM products WHERE subcategory_id = :subcategory_id');

$criteriaSubcat = [
  'subcategory_id' =>  $_GET['subcategory']
];

$stmtGetSubcategory -> execute($criteriaSubcat);

while($product = $stmtGetSubcategory->fetch()){
  echo $product['product_name'];
}
 ?>
