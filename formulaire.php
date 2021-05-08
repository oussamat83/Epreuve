<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Créer un article</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>

    <body>
        <form method="POST" action="dataformulaire.php">
                  Titre : <br/>
                <input type="text" name="titre" required/><br/>
                  Contenu : <br/>
                <textarea name="contenu" required ></textarea><br/>
                <input type="submit" name="submit" value="Publier"/>
        </form>
        
    </body>

</html>