<?php

use function PHPSTORM_META\map;

  session_start();
  if(!isset($_SESSION['name'])) {
    header("Location: ../index.php");
  }
?>

<?php require_once 'parts/header.php'; ?>

<?php 
// connect to db
$connectDatabase = new PDO("mysql:host=db;dbname=recipebox", "root", "admin");
// prepare request
$request = $connectDatabase->prepare("SELECT * FROM `recettes` WHERE user_id = :id");
// bindparams
$request->bindParam(':id', $_SESSION['id']);
// execute request
$request->execute();
// fetch all data from table posts
$result = $request->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- show data in html -->
<section>
  <?php foreach ($result as $recette) : ?>
    <?php
      // liste des ingredients
      $ingredients = preg_split('/,\s*/', $recette['ingredients']);
      // liste des étapes
      $steps = preg_split('/,\s*/', $recette['steps']);
      // source de l'image
      $img_src = $recette['img'];
    ?>
    <img src="<?= $img_src ?>" alt="recette<?= $recette['id']?>">
    <p>Liste des ingrédients :</p>
    <ul>
      <?php foreach($ingredients as $ingredient){ echo('<li>' . $ingredient . '</li>'); } ?>
    </ul>
    <p>Etapes :</p>
    <ol type="1">
      <?php foreach($steps as $step){ echo('<li>' . $step . '</li>'); } ?>
    </ol>
  <?php endforeach; ?>
</section>

<?php require_once 'parts/footer.php'; ?>