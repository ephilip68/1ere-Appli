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
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="style.css">

    <title>Récapitulatif des produits</title>
</head>
<body>
<h1>Récapitulatif des produits</h1>

    <?php 
    
    // Soit clé 'product' du tableau $_SESSION n'existe pas "!isset()" soit cette clé existe mais est vide "empty()"
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){

        // Afichera donc à l'utilisateur un message lui disant qu'aucun produit existe en session
        echo "<p>Aucun produit en session...</p>";

    } else{
        // Affichera nos produits dans un tableau HTML
        echo "<table class='uk-table uk-table-hover' id='recap'>",
                "<thead id='category'>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                    "</tr>",
                "</thead>",
                "<tbody>";
                
        $totalGeneral = 0;
        $nbArticle = 0;

        foreach($_SESSION['products'] as $index => $product){

            echo "<tr id='product_hover'>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    //Number_format permet de modifier l'affichage d'une valeur numérique
                    "<td>".number_format($product['price'], 2,",","&nbsp;")."&nbsp;€</td>",
                    "<td>".$product['qtt']."</td>",
                    "<td>".number_format($product['total'], 2,",","&nbsp;")."&nbsp;€</td>",
                "</tr>";

            $totalGeneral+= $product['total'];
          
            $_SESSION['nbArticles'] = $nbArticle+= $product['qtt'];
            
        }

        echo   "</tbody>",
              "</table>",
              "<div id='article'>",
                "<span><strong>Total Articles : </strong></span>",
                "<span><strong>".number_format($nbArticle, 0,"&nbsp;")."&nbsp;</strong></span>",
              "</div>",
              "<div id='total'>",
                "<span ><strong>Total Prix : </strong></span>",
                "<span><strong>".number_format($totalGeneral, 2,",","&nbsp;")."&nbsp;€</strong></span>",
              "</div>",
              "<div id='redirection'><a href='index.php'>Ajouter un produit</a></div>",
              "<a href='traitement.php?action=clear'>Clear</a>";
    
    }
    
    ?>


<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit-icons.min.js"></script>
</body>
</html>