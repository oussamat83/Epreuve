<?php
try {
    $db = new PDO("mysql:host=localhost;charset=UTF8;dbname=article", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $err){
    echo "Impossible d'initialiser une connection avec la base de données. Veuillez rééssayer plus tard.";
    die();
}


// if (isset($_POST["titre"], $_POST["contenu"]) && !empty($_POST["titre"]) && !empty($_POST["contenu"]))
// {
//     $titre =htmlspecialchars(addslashes($_POST["titre"]));
//     $titre =htmlspecialchars(addslashes($_POST["contenu"]));

//     $db = new PDO('mysql:host=localhost;charset=UTF8;dbname=article', 'root', '');
//     $sql = "INSERT INTO article (titre, contenu) VALUES (':titre', ':contenu')";
//     $request = $db->prepare($sql);
//     $request->bindParam(':titre', $titre);
//     $request->bindParam(':contenu', $contenu);
//     $request->execute();

//     Header("Location:index.php");
// }

?>