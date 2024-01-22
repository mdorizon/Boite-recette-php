<?php
$title_post = $_POST['title'];

if(empty($title_post)) {
  header("Location: ../index.php?error=Veuillez renseigner un titre");
}

// connect to db with PDO
$connectDatabase = new PDO("mysql:host=localhost;dbname=wordpress", "root", "admin");
// prepare request
$request = $connectDatabase->prepare("INSERT INTO posts (title) VALUES (:title)");
// bind params
$request->bindParam(':title', $title_post);
// execute request
$request->execute();