<?php
require "connect.php";
require "helpers.php";


$errors = [];
// On verifie que la methode post existe, si elle existe on execute la requete
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(existPOST("titreArticle")){
       $sql = "INSERT INTO article 
       (titreArticle, dateCreationArticle, datePublication, statueArticle, contenuArticle) 
       VALUES (:titreArticle, '2018/10/10', '2019/10/10', 'Publié', 'area')";

       $stmt = $db->prepare($sql);
       $res = $stmt->execute([
          ":titreArticle" => htmlspecialchars($_POST["titreArticle"])
          //":contenuArticle" => htmlspecialchars($_POST["contenuArticle"]),
          //"dateCreationArticle" => $_POST["dateCreationArticle"],
          //"statutArticle" => htmlspecialchars($_POST["statutArticle"]),
          //":idCategorie" => htmlspecialchars($_POST["idCategorie"]),
          //':idTag' => htmlspecialchars($_POST["idTag"])
       ]);

   // on verifie si la reponse est vrai ou fausse
   //     if ($res=== true){
            redirectTo("index.php");
   //     }else{
   //         $errors[] = "Erreur lors de la sauvegarde des données. Veuillez réessayer plus tard";
   //     }
       }else{
           $errors[] = "Veuillez remplir tous les champs";
       }
   }
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier article</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>

    <body>
        <div class="container d-flex flex-column align-items-center">
            <h1>Modifier article</h1>
            <?php foreach($errors as $error){ ?>
                <div class="alert alert-warning">
                    <?= $error ?>
                </div>
            <?php } ?>
            <form method="POST" >
                Titre : <br/>
                <input type="text" name="titreArticle" placeholder="Titre de l'article" required/><br/>
                Contenu : <br/>
                <textarea name="contenuArticle" required ></textarea><br/>
                <input type="submit" name="submit" class="btn btn-primary" value="Publier" />
                <input type="submit" name="submit" class="btn btn-primary" value="sauvegarder" />
            </form>
        
        
            <div class="card p-4 w-50">
                <form method="POST">
                    <div class="d-flex justify-content-between">
                        <div class="form-group w-50">
                            <label for="input-lieu">Catégorie</label><br/>
                            <select id="input-lieu" name="idCategorie">
                                <option value="">aucun</option>
                                <option>patisserie</option>
                                <option>gateau</option>
                                <option>vienoiserie</option>
                                <option>pain</option>
                            </select>
                        </div>
                        <div class="form-group w-50">
                            <label for="input-groupe">tags</label><br/>
                            <select id="input-groupe" name="idTag">
                                <option>Groupe 1</option>
                                <option>Groupe 2</option>
                                <option>Groupe 3</option>
                                <option>Groupe 4</option>
                            </select>
                        </div>
                    
                    <button type="submit" class="mt-3 btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </body>

</html>

