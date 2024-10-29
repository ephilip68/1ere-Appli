<?php

// Afin de pouvoir récupérer et parcourir le tableau session il est nécessaire d'appeller cette fonction en début de fichier
session_start();

$message = isset($_SESSION['msg']) ? $_SESSION['msg']:"";

$nbArticle = 0;

        foreach($_SESSION['products'] as $index => $product){

            $nbArticle+= $product['qtt'];
        }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/css/uikit.min.css" />
        <link rel="stylesheet" href="style.css">
        <script src="style.js"></script>
        <title>Ajout produit</title>
    </head>
    <body>
        <h1>Ajouter un produit</h1>

        <?php if(!empty($message)) ?>

        <div class="uk-alert-success" uk-alert id='message'>
            <a href class="uk-alert-close" uk-close></a>
            <p><?php echo $message ?></p>
        </div>
        <form class="element" action="traitement.php?action=add" method="post">
            <p>
                <label>
                    Nom du Produit :
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du Produit :
                    <input type="number" step="any" name="price" min="0">
                </label>
            </p>
            <p>
                <label>
                    Quantité Désirée :
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p class="btn">
                <input  type="submit" name="submit" value="Ajouter au Panier">
            </p>
        </form>
        <div class="panier">
            <span><strong>Mon Panier</strong></span>
            <span class="total-panier"><strong><?php echo $nbArticle;?></strong></span>
            <a href='recap.php'class='icon-cart' uk-icon='icon:cart'></a> 
        </div>
    </body>

<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit-icons.min.js"></script>

</html>