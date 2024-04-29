<?php
$hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if(empty($_POST['username'])) {
  header("Location: ../signup.php?error=Veuillez renseigner un nom d'utilisateur");
  die(); // interruption du script
}
if(empty($_POST['password'])) {
  header("Location: ../signup.php?error=Veuillez renseigner un mot de passe");
  die(); // interruption du script
}

  // connect to db with PDO
  $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
  // prepare request
  $request = $connectDatabase->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
  // bind params
  $request->bindParam(':username', $_POST['username']);
  $request->bindParam(':password', $hash_password);
  // execute request
  $request->execute();

  header("Location: ../index.php?success=Vous avez bien créé votre compte !");