<?php 
$post_id = $_GET['id'];

// connect to db
$connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
// prepare request
$request = $connectDatabase->prepare("DELETE FROM posts WHERE id= :id");
// bindparams (pour proteger des injections)
$request->bindParam(':id', $post_id);
// execute request
$request->execute();

header("Location: ../index.php?success=Le post a bien été ajouté");