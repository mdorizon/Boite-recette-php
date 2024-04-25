<?php 
$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username)) {
  header("Location: ../index.php?error=Veuillez renseigner un nom d'utilisateur");
  die(); // interruption du script
}
if(empty($password)) {
  header("Location: ../index.php?error=Veuillez renseigner un mot de passe");
  die(); // interruption du script
}

// connect to db
$connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
// prepare request
$request = $connectDatabase->prepare("SELECT * FROM `users` WHERE username = :username AND password = :password");
// bindparams (pour proteger des injections)
$request->bindParam(':username', $username);
$request->bindParam(':password', $password);
// execute request
$request->execute();
$user = $request->fetchAll(PDO::FETCH_ASSOC);

if(empty($user)) {
  header("Location: ../index.php?error=Utilisateur ou mot de passe incorrect !");
  die(); // interruption du script
}

session_start();
$_SESSION["username"]=$username;

header("Location: ../index.php?success=Vous avez bien été connecté !");