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
  <?php if (count($result) == 0) : ?>
    <div class="text-center">
      <h2 class="mt-5">Bonjour <?= $_SESSION['name']; ?>, Soyez le premier à poster une recette</h2>
      <button class="btn btn-primary mt-4">Ajouter</button>
    </div>
  <?php else: ?>
    <?php foreach ($result as $recette) : ?>
      <?php
        // liste des ingredients
        $ingredients = preg_split('/;\s*/', $recette['ingredients']);
        // liste des étapes
        $steps = preg_split('/;\s*/', $recette['steps']);
      ?>
      <div class="d-flex mt-5 mb-5">
        <img class="w-50" src="<?= $recette['img'] ?>" alt="recette<?= $recette['id']?>">
        <div class="ms-5 mt-5">
          <h2><?= $recette['name'] ?></h2>
          <p>Liste des ingrédients :</p>
          <ul>
            <?php foreach($ingredients as $ingredient){ echo('<li>' . $ingredient . '</li>'); } ?>
          </ul>
          <p>Etapes :</p>
          <ol type="1">
            <?php foreach($steps as $step){ echo('<li>' . $step . '</li>'); } ?>
          </ol>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>

<?php require_once 'parts/footer.php'; ?>