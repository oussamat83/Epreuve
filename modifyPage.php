<?php
require "connect.php";
require "helpers.php";

if(validGET("id")){
    $idArticleToEdit = $_GET["id"];
    $stmt = $db->prepare("SELECT * from article WHERE idArticle = :idArticleToEdit;");
    $stmt->execute([
        ':idArticleToEdit' => $idArticleToEdit
     ]);
     $blogEdit = $stmt->fetchAll(); 
    //  print_r($blogEdit);

     $valueIdArticle = $blogEdit[0]['idArticle'];
     $valueTitre = $blogEdit[0]['titreArticle'];
     $valueArea = $blogEdit[0]['contenuArticle'];
     $valueToTestTemp = $blogEdit[0]['idCategorie'];
}

$errors = [];
// On verifie que la methode post existe, si elle existe on execute la requete
// if($_SERVER["REQUEST_METHOD"] === "POST"){
//     if(existPOST("titreArticle")){
//        $sql = "INSERT INTO article 
//        (titreArticle, dateCreationArticle, datePublication, statueArticle, contenuArticle) 
//        VALUES (:titreArticle, '2018/10/10', '2019/10/10', 'Publié', 'area')";

//        $stmt = $db->prepare($sql);
//        $res = $stmt->execute([
//           ":titreArticle" => htmlspecialchars($_POST["titreArticle"])
//           //":contenuArticle" => htmlspecialchars($_POST["contenuArticle"]),
//           //"dateCreationArticle" => $_POST["dateCreationArticle"],
//           //"statutArticle" => htmlspecialchars($_POST["statutArticle"]),
//           //":idCategorie" => htmlspecialchars($_POST["idCategorie"]),
//           //':idTag' => htmlspecialchars($_POST["idTag"])
//        ]);

 
//             redirectTo("index.php");
 
//        }else{
//            $errors[] = "Veuillez remplir tous les champs";
//        }
//    }

   if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["titreArticle"])){
        $statueArticle = "Publié";
        

        $stmt = $db->prepare("
        UPDATE article SET 
        titreArticle = :titreArticle, 
        contenuArticle = :contenuArticle, 
        statueArticle = :statueArticle 
        WHERE idArticle = :idArticle;
        ");
        $stmt->execute([
            ':titreArticle' => htmlspecialchars($_POST["titreArticle"]), 
            ':contenuArticle' => htmlspecialchars($_POST["contenuArticle"]), 
            ':statueArticle' => $statueArticle, 
            ':idArticle' => htmlspecialchars($_POST["idArticle"])
         ]);

    }
    header("Location: ./index.php");
}


?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier l'article</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>

    <body>
            <div class="container d-flex flex-column align-items-center">
                <h1>Modifier l'article</h1>
                <?php foreach($errors as $error){ ?>
                    <div class="alert alert-warning">
                        <?= $error ?>
                    </div>
                <?php } ?>

                <form method="POST" >
                    Titre : <br/>
                    <input type="hidden" value="<?= $valueIdArticle ?>" name="idArticle" placeholder="">
                    <input type="text" value="<?= $valueTitre ?>" name="titreArticle" placeholder="Titre de l'article" required/><br/>
                    Contenu : <br/>
                    <textarea name="contenuArticle" class="form-label"required ><?= $valueArea ?></textarea><br/>
                    <input type="submit" name="submit" class="btn btn-primary" value="Publier" />
                    <input type="submit" name="submit" class="btn btn-primary" value="sauvegarder" />
                    <a class="btn btn-success active" href="delete.php?id=<?= $valueIdArticle ?>">Supprimer</a>
                </form>
            
            
                <div class="card p-4 w-50">
                    <form method="POST">
                        <div class="d-flex justify-content-between">
                            <div class="form-group w-50">
                                <label for="input-lieu">Catégorie</label><br/>
                                <select id="input-lieu" name="nomCategorie">
                                    <option>Cake</option>
                                    <option>Sweets</option>
                                </select>
                            </div>

                            <div class="form-group w-50">
                                <label for="input-statutArticle">Statue Article</label><br/>
                                <select id="input-statutArticle" name="statueArticle">
                                    <option>Publié</option>
                                    <option>Brouillon</option>
                                    <option>Corbeille</option>
                                </select>
                        </div>

                            <div class="form-group w-50">
                                <label for="input-groupe">tags</label><br/>
                                <select id="input-groupe" name="nomTag">
                                    <option >Jelly</option>
                                    <option>Fudge</option>
                                    <option>Beans</option>
                                </select>
                            </div>
                        </div>  
                    <button type="submit" class="mt-3 btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
    </body>
</html>

