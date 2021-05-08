<?php
require "connect.php";
require "helpers.php";

if(!validGET("idArticle")){
    redirectTo("modifyPage.php");
}
$id = $_GET["idArticle"];
$errors = [];

// Vérification de la ligne de données
$stmt = $db->prepare("SELECT * FROM article WHERE id=idArticle");

$value = null;
if($stmt->execute([$id])){
    $value = $stmt->fetch();
}else{
    $errors[] = "Wakon";
}

// Protection CSRF
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];


if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["modify"])){ 

    }
}
?>