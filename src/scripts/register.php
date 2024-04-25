<?php
$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username)) {
  header("Location: ../signup.php?error=Veuillez renseigner un nom d'utilisateur");
  die(); // interruption du script
}
if(empty($password)) {
  header("Location: ../signup.php?error=Veuillez renseigner un mot de passe");
  die(); // interruption du script
}

  // connect to db with PDO
  $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
  // prepare request
  $request = $connectDatabase->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
  // bind params
  $request->bindParam(':username', $username);
  $request->bindParam(':password', $password);
  // execute request
  $request->execute();

  header("Location: ../index.php?success=Vous avez bien créé votre compte !");