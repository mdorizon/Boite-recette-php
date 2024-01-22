<?php
$title_post = $_POST['title'];

if(empty($title_post)) {
  header("Location: ../index.php?error=Veuillez renseigner un titre");
}