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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>

<body>

    <div class="box">

        <div class="container">
            <h1>Création d'un article</h1>
        </div>

        <form method="POST">


            <div class="d-flex">
                <div class="container col-10">

                    <?php foreach($errors as $error){ ?>
                    <div class="alert alert-warning">
                        <?= $error ?>
                    </div>
                    <?php } ?>

                    <input type="text" class="form-control" name="titreArticle" placeholder="Titre de l'article"
                        required /><br />

                    <textarea class="form-control" rows="20" name="contenuArticle" placeholder="Super contenu..."
                        required></textarea><br />

                </div>

                <div class="container col-2">

                    <div class="card p-2 mb-3">

                        <div class="mb-3">
                            <input type="submit" name="submit" class="btn btn-primary" value="Publier" />
                        </div>
                        <div>
                            <input type="submit" name="submit" class="btn btn-primary" value="sauvegarder" />
                        </div>

                    </div>


                    <div class="card p-2">

                        <div class="form-group w-50">
                            <label for="input-categorie">Catégorie</label><br />
                            <select id="input-categorie" name="nomCategorie">
                                <option>Cake</option>
                                <option>Sweets</option>
                            </select>
                        </div>

                        <div class="form-group w-50">

                            <label for="">Statut Article</label><br />
                            <select id="" name="statueArticle">
                                <option>Publié</option>
                                <option>Brouillon</option>
                                <option>Corbeille</option>
                            </select>
                        </div>

                        <div class="form-group w-50">

                            <label for="">tags</label><br />
                            <select id="" name="nomTag">
                                <option>Jelly</option>
                                <option>Fudge</option>
                                <option>Beans</option>
                            </select>

                            <div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Broullion</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Publié</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Supprimés</label>
                                </div>

                                <button type="submit" class="mt-3 btn btn-primary">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>