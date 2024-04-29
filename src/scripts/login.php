<?php 

if(empty($_POST['nombre'])) {
  header("Location: ../index.php?error=Introduzca un nombre de usuario");
  die(); // interrupción del guión
}

// conectar con db
$connectDatabase = new PDO("mysql:host=db;dbname=recipebox", "root", "admin");
// preparar la solicitud
$request = $connectDatabase->prepare("SELECT * FROM `recettas` WHERE nombre = :nombre");
// bindparams (para proteger contra inyecciones)
$request->bindParam(':nombre', $_POST['nombre']);
// ejecutar solicitud
$request->execute();
$result = $request->fetch(PDO::FETCH_ASSOC);

if(!$result) {
  header("Location: ../index.php?error=Usuario no encontrado !");
  die();
}

session_start();
$_SESSION["nombre"] = $_POST['nombre'];
$_SESSION["id"] = $result['id'];

header("Location: ../recettas.php");