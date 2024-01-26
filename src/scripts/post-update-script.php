<?php 
$post_id = $_GET['id'];
$title_post = $_POST['title'];

if(empty($title_post)) {
  header("Location: ../index.php?error=Veuillez renseigner un titre");
  die(); // interruption du script
}

// connect to db
$connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
// prepare request
$request = $connectDatabase->prepare("UPDATE `posts` SET title= :title WHERE id= :id");
// bindparams (pour proteger des injections)
$request->bindParam(':id', $post_id);
$request->bindParam(':title', $title_post);
// execute request
$request->execute();

header("Location: ../index.php?success=Le post a bien été modifié");