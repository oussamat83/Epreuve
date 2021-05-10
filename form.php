<?php
require "connect.php";
require "helpers.php";



$errors = [];
// On verifie que la methode post existe, si elle existe on execute la requete
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["titreArticle"])){

       $stmt = $db->prepare("
       INSERT INTO article 
        (titreArticle, dateCreationArticle, statueArticle, contenuArticle, idCategorie) 
        VALUES (:titreArticle, CURDATE(), :statueArticle, :contenuArticle, 
        (SELECT idCategorie FROM categorie WHERE nomCategorie = :nomCategorie));
        ");
       $stmt->execute([
            ':titreArticle' => htmlspecialchars($_POST["titreArticle"]), 
            ':statueArticle' => htmlspecialchars($_POST["statueArticle"]), 
            ':contenuArticle' => htmlspecialchars($_POST["contenuArticle"]), 
            ':nomCategorie' => htmlspecialchars($_POST["nomCategorie"])
       ]);
                

        }else{
            $errors[] = "Veuillez remplir tous les champs";
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
        <title>Créer un article</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>

    <body>
        <div classe="entête">
            <form method="POST">
                <div class="container d-flex flex-column align-items-center">
                    <h1>Création d'un article</h1>
                        <?php foreach($errors as $error){ ?>
                            <div class="alert alert-warning">
                                <?= $error ?>
                            </div>
                        <?php } ?>
                    
                        Titre : <br/>
                        <input type="text" name="titreArticle" placeholder="Titre de l'article" required/><br/>
                        Contenu : <br/>
                        <textarea name="contenuArticle" placeholder="Super contenu..." required ></textarea><br/>
                        <input type="submit" name="submit" class="btn btn-primary" value="sauvegarder" />
                    
        
        
                        
                            <div class="card p-4 w-50">
                                
                                <div class="d-flex justify-content-between">
                                    <div class="form-group w-50">
                                        <label for="input-lieu">Catégorie</label><br/>
                                        <select id="input-lieu" name="nomCategorie">
                                            <option>Cake</option>
                                            <option>Sweets</option>
                                        </select>
                                    </div>

                                    <div class="form-group w-50">
                                        <label for="">Statut Article</label><br/>
                                        <select id="" name="statueArticle">
                                            <option>Publié</option>
                                            <option>Brouillon</option>
                                            <option>Corbeille</option>
                                        
                                        </select>
                                </div>
                                <div class="form-group w-50">
                                    <label for="">tags</label><br/>
                                    <select id="" name="nomTag">
                                        <option >Jelly</option>
                                        <option>Fudge</option>
                                        <option>Beans</option>
                                    
                                    </select>
                                </div>

                                <button type="submit" class="mt-3 btn btn-primary">Ajouter</button>
                            </div>
                </div>
            </form>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexSwitchCheckChecked">Broullion</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexSwitchCheckChecked">Publié</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                <label class="form-check-label" for="flexSwitchCheckChecked">Supprimés</label>
            </div>

            <div class="form-group w-50">
                <label for="input-groupe">tags</label><br/>
                    <select id="input-groupe" name="nomTag">
                        <option >Jelly</option>
                        <option>Fudge</option>
                        <option>Beans</option>
                    </select>
            </div>
            <div class="form-group w-50">
                <label for="input-lieu">Catégorie</label><br/>
                    <select id="input-lieu" name="nomCategorie">
                        <option>Cake</option>
                        <option>Sweets</option>
                    </select>
            </div>
        </div>
    </body>

</html>

