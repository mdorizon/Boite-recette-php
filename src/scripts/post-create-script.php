<?php
session_start();

$title_post = $_POST['title'];

if(empty($title_post)) {
  header("Location: ../index.php?error=Veuillez renseigner un titre");
  die(); // interruption du script
}

  // connect to db with PDO
  $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
  // prepare request
  $request = $connectDatabase->prepare("INSERT INTO posts (title, user_id) VALUES (:title, :user_id)");
  // bind params
  $request->bindParam(':title', $title_post);
  $request->bindParam(':user_id', $_SESSION["id"]);
  // execute request
  $request->execute();

  header("Location: ../post-list.php?success=Le post a bien été ajouté");