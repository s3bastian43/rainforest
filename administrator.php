<?php
$title = 'Administrator area';

include('session.php');
require 'header.php';
if (!isset($_SESSION['login_user'])) {
   header("Location: signin.php");
   exit();
}
 ?>
   <section class="mainAdmin">
     <div class="row">
       Add categories
     </div>
        <hr class="article">

        <div class="addCategory">
            <div class="leftArticle">

                <form action="administrator.php" method="post">
                <label for="category"><b>Main category name:</b></label>
                <input type="text" name="category" value="<?php if(isset($_POST['category'])) { echo $_POST['category']; } else{ "";} ?>">
                <button type="submit" class="categoryBtn">Add category</button>
              </form>

            </div>
            <div class="rightArticle">

              <b>Add a subcategory</b>
            </br>
            </br>
              <form action="administrator.php" method="post">
              <label for="mainCategory">Main category</label>
                <select name="mainCategory">
              <?php

                $stmtGetlastID = $pdo->prepare('SELECT * FROM categories');
                $stmtGetlastID->execute();
                while($getCategories = $stmtGetlastID->fetch()){
                  echo '<option value="' . $getCategories['category_id'] . '">' . $getCategories['category_name'] . '</option>';
                }
              ?>
              </select>
              <label for="subcategory">Subcategory name</label>
              <input type="text" name="subcategory" value="<?php if(isset($_POST['subcategory'])) { echo $_POST['subcategory']; } else{ "";} ?>">

              <button type="submit" class="categoryBtn">Add subcategory</button>
            </form>

          </div>
  </div>
   </section>

   <section class="mainAdmin">
     <div class="row">
       Update categories
     </div>
        <hr class="article">

        <div class="addCategory">
            <div class="leftArticle">

                <form action="administrator.php" method="post">
                  <label for="UPmainCategory"><b>Select the category you want to update</b></label>
                    <select name="UPmainCategory">
                  <?php
                    $stmtGetlastID->execute();
                    while($getCategories = $stmtGetlastID->fetch()){
                      echo '<option value="' . $getCategories['category_id'] . '">' . $getCategories['category_name'] . '</option>';
                    }
                  ?>
                  </select>
                  <label for="UPcategory">New category name:</label>
                  <input type="text" name="UPcategory" value="<?php if(isset($_POST['UPcategory'])) { echo $_POST['UPcategory']; } else{ "";} ?>">

                <button type="submit" class="categoryBtn">Update category</button>
              </form>

            </div>
            <div class="rightArticle">
              <form action="administrator.php" method="post">

                <label for="UPsubcategorySel"><b>Select the subcategory you want to update</b></label>
                  <select name="UPsubcategorySel">
                  <?php
                    $stmtGetSubcategory = $pdo->prepare('SELECT * FROM subcategories');
                    $stmtGetSubcategory->execute();
                    while($getSubcategories = $stmtGetSubcategory->fetch()){
                      echo '<option value="' . $getSubcategories['subcategory_id'] . '">' . $getSubcategories['subcategory_name'] . '</option>';
                    }
                  ?>
                </select>
              <label for="UPsubcategory">New subcategory name</label>
              <input type="text" name="UPsubcategory" value="<?php if(isset($_POST['UPsubcategory'])) { echo $_POST['UPsubcategory']; } else{ "";} ?>">

              <button type="submit" class="categoryBtn">Update subcategory</button>
            </form>

          </div>
  </div>
   </section>

   <section class="mainAdmin">
     <div class="row">
       Delete categories
     </div>
        <hr class="article">

        <div class="addCategory">
            <div class="leftArticle">

                <form action="administrator.php" method="post">

                  <b>Delete a category:</b>
                  <br/>
                  <br/>
                  <label for="DmainCategory">Select the category you want to delete</label>
                    <select name="DmainCategory" title="Deleting a category will delete all the subcategories too">
                  <?php
                    $stmtGetlastID->execute();
                    while($getCategories = $stmtGetlastID->fetch()){
                      echo '<option value="' . $getCategories['category_id'] . '">' . $getCategories['category_name'] . '</option>';
                    }
                  ?>
                  </select>
                <br/>
                <br/>
                <button type="submit" class="categoryBtn" name="delCat">Delete category</button>
              </form>

            </div>
            <div class="rightArticle">

              <b>Delete a subcategory</b>
            </br>
            </br>
              <form action="administrator.php" method="post">

              <label for="Dsubcategory">Select the subcategory you want to delete</label>
                <select name="Dsubcategory">
                <?php
                  $stmtGetSubcategory = $pdo->prepare('SELECT * FROM subcategories');
                  $stmtGetSubcategory->execute();
                  while($getSubcategories = $stmtGetSubcategory->fetch()){
                    echo '<option value="' . $getSubcategories['subcategory_id'] . '">' . $getSubcategories['subcategory_name'] . '</option>';
                  }
                ?>
              </select>
              <br/>
              <br/>
              <button type="submit" class="categoryBtn" name="delSubcat">Delete subcategory</button>
            </form>

          </div>
  </div>
   </section>

 <?php

require 'footer.php';
//Adding
// Categories
  if (isset($_POST['category'])){

    $stmtCategory = $pdo->prepare('INSERT INTO categories(category_name) VALUES(:category_name)');
    $stmtGetlastID = $pdo->prepare('SELECT * FROM categories');

    $stmtGetlastID->execute();

    foreach ($stmtGetlastID as $row) {
      $row['category_id'];
    }

    $stmtAI = $pdo->prepare('ALTER TABLE categories AUTO_INCREMENT = ' .  $row['category_id']);

    $stmtAI->execute();

    $criteriaCategory = [
      'category_name' => $_POST['category']
    ];

    $stmtCategory->execute($criteriaCategory);

    echo  '<script type="text/javascript">
              window.alert("Category created");
              window.location.href="administrator.php";
          </script>';
  exit;
  }

// Subcategories
  if (isset($_POST['subcategory'])){

    //Get the last subcategory_id
      $stmtGetSubcategory = $pdo->prepare('SELECT * FROM subcategories');

      $stmtGetSubcategory->execute();

      foreach ($stmtGetSubcategory as $rowSubcategory) {
        $rowSubcategory['subcategory_id'];
      }

      $stmtAISubcat = $pdo->prepare('ALTER TABLE subcategories AUTO_INCREMENT = ' . $rowSubcategory['subcategory_id']);
      //Couldn't use prepared statements here
      $stmtAISubcat->execute();


    // Insert subcategory
      $stmtSubcategory = $pdo->prepare('INSERT INTO subcategories(category_id, subcategory_name) VALUES(:category_id, :subcategory_name)');

      $criteriaSubcategory = [
        'category_id' => $_POST['mainCategory'],
        'subcategory_name' => $_POST['subcategory']
      ];

      $stmtSubcategory->execute($criteriaSubcategory);

    //If successful
    echo  '<script type="text/javascript">
              window.alert("Subcategory created");
              window.location.href="administrator.php";
          </script>';
  exit;
}


//Deleting
    if (isset($_POST['delCat'])){
      $stmtDcategory = $pdo->prepare('DELETE FROM categories WHERE category_id = :category_id LIMIT 1');
      $stmtDsubcategoryToo = $pdo->prepare('DELETE FROM subcategories WHERE category_id = :category_id LIMIT 1');

      $criteriaDcategory = [
        'category_id' => $_POST['DmainCategory']
      ];

      $stmtDcategory->execute($criteriaDcategory);
      $stmtDsubcategoryToo->execute($criteriaDcategory);

    //If successful
    echo  '<script type="text/javascript">
              window.alert("Category deleted");
              window.location.href="administrator.php";
          </script>';
  exit;
}

  if (isset($_POST['delSubcat'])){
          $stmtDsubcategory = $pdo->prepare('DELETE FROM subcategories WHERE subcategory_id = :subcategory_id LIMIT 1');

          $criteriaDsubcategory = [
            'subcategory_id' => $_POST['Dsubcategory']
          ];

          $stmtDsubcategory->execute($criteriaDsubcategory);

          echo  '<script type="text/javascript">
                    window.alert("Subategory deleted");
                    window.location.href="administrator.php";
                </script>';
        exit;
  }

//Updates
    if (isset($_POST['UPcategory'])){

      $stmtUPcategory = $pdo->prepare('UPDATE categories SET category_name = :category_name WHERE category_id= :category_id');

      $criteriaUPcategory = [
        'category_id' => $_POST['UPmainCategory'],
        'category_name' => $_POST['UPcategory']
      ];

      $stmtUPcategory->execute($criteriaUPcategory);

    echo  '<script type="text/javascript">
                window.alert("Category updated");
                window.location.href="administrator.php";
            </script>';
    exit;
    }

    if (isset($_POST['UPsubcategory'])){

      $stmtUPsubcategory = $pdo->prepare('UPDATE subcategories SET subcategory_name = :subcategory_name WHERE subcategory_id= :subcategory_id');

      $criteriaUPsubcategory = [
        'subcategory_id' => $_POST['UPsubcategorySel'],
        'subcategory_name' => $_POST['UPsubcategory']
      ];

      $stmtUPsubcategory->execute($criteriaUPsubcategory);

    echo  '<script type="text/javascript">
                window.alert("Subategory updated");
                window.location.href="administrator.php";
            </script>';
    exit;
    }
?>
