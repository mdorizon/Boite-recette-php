<?php 

if(empty($_POST['username'])) {
  header("Location: ../index.php?error=Veuillez renseigner un nom d'utilisateur");
  die(); // interruption du script
}
if(empty($_POST['password'])) {
  header("Location: ../index.php?error=Veuillez renseigner un mot de passe");
  die(); // interruption du script
}

// connect to db
$connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
// prepare request
$request = $connectDatabase->prepare("SELECT * FROM `users` WHERE username = :username");
// bindparams (pour proteger des injections)
$request->bindParam(':username', $_POST['username']);
// execute request
$request->execute();
$result = $request->fetch(PDO::FETCH_ASSOC);

if(!$result) {
  header("Location: ../index.php?error=Utilisateur introuvable !");
  die();
}

$isValidPassword = password_verify($_POST['password'], $result['password']);

if(!$isValidPassword) {
  header("Location: ../index.php?error=Utilisateur ou mot de passe incorrect !");
  die(); // interruption du script
}

session_start();
$_SESSION["username"]=$_POST['username'];
$_SESSION["id"]= $result['id'];

header("Location: ../index.php?success=Vous avez bien été connecté !");