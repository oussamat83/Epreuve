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
        statueArticle = :statueArticle, 
        contenuArticle = :contenuArticle, 
        idCategorie = (SELECT idCategorie FROM categorie WHERE nomCategorie = :nomCategorie)
        WHERE idArticle = :idArticle;
        ");
        $stmt->execute([
            ':titreArticle' => htmlspecialchars($_POST["titreArticle"]), 
            ':contenuArticle' => htmlspecialchars($_POST["contenuArticle"]), 
            ':statueArticle' => htmlspecialchars($_POST["statueArticle"]), 
            ':nomCategorie' => htmlspecialchars($_POST["nomCategorie"]),
            ':idArticle' => htmlspecialchars($_POST["idArticle"])
         ]);

    }
   header("Location: ./index.php");
    // echo "alexandre le miboune que je goum ";
    // print_r($_POST);
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>

<body>

    <div class="box">

        <div class="container">
            <h1>Modifier l'article</h1>
        </div>

        <form method="POST">

            <div class="d-flex">
                <div class="container col-10">

                    <?php foreach($errors as $error){ ?>
                    <div class="alert alert-warning">
                        <?= $error ?>
                    </div>
                    <?php } ?>

                    <form method="POST"> 

                    <input type="hidden" class="form-control" value="<?= $idArticleToEdit ?>" name="idArticle"
                            placeholder="Titre de l'article" />

                        <input type="text" class="form-control" value="<?= $valueTitre ?>" name="titreArticle"
                            placeholder="Titre de l'article" required /><br />

                        <textarea class="form-control" rows="20" name="contenuArticle" placeholder="Super contenu..."
                            required><?= $valueArea?></textarea><br />

                </div>


                <div class="container col-2">

                    <div class="card p-2 mb-3">

                        <div class="mb-3">
                            <input type="submit" name="submit" class="btn btn-primary" value="Publier" />
                        </div>
                        <div>
                            <input type="submit" name="submit" class="btn btn-primary" value="sauvegarder" />
                        </div>
                        <div class=" p-2">
                            <a class="btn btn-danger active bi bi-trash"
                                href="delete.php?id=<?= $valueIdArticle ?>"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg></a>
                        </div>

                    </div>

                    <div class="card p-2">

                        <div class="form-group w-50">
                            <label for="input-lieu">Catégorie</label><br />
                            <select id="input-lieu" name="nomCategorie">
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

                        </div>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary">Ajouter</button>
                </div>
        </form>
    </div>
</body>

</html>