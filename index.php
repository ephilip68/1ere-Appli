<?php

// Afin de pouvoir récupérer et parcourir le tableau session il est nécessaire d'appeller cette fonction en début de fichier
session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/css/uikit.min.css" />
        <link rel="stylesheet" href="style.css">
        <title>Ajout produit</title>
    </head>
    <body>
        <h1>Ajouter un produit</h1>
        <div class="uk-alert-success" uk-alert>
            <a href class="uk-alert-close" uk-close></a>
            <p><?php echo $_SESSION['msg']?></p>
        </div>
        <form action="traitement.php?action=add" method="post">
            <p>
                <label>
                    Nom du produit :
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        <div id='article'>
            <span><strong>Total Articles : </strong></span>
            <span><strong><?php echo $_SESSION["nbArticles"]; ?></strong></span>
        </div>
        <a href='recap.php'>recapitulatif</a> 
    </body>

<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit-icons.min.js"></script>
</html>