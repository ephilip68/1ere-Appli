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
    <div class="container">
        <h1>Votre Panier</h1>
        <div id='redirection'><span class="icon-arrow" uk-icon='icon:arrow-left'></span><a href='index.php'>Ajouter un produit</a></div>

    <?php 
    
    // Soit clé 'product' du tableau $_SESSION n'existe pas "!isset()" soit cette clé existe mais est vide "empty()"
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){

        // Afichera donc à l'utilisateur un message lui disant qu'aucun produit existe en session
        echo "<p>Aucun produit en session...</p>";

    } else{
        // Affichera nos produits dans un tableau HTML
        echo "<div id='cantainer-category'><table class='uk-table uk-table-hover' id='recap'>",
                "<thead id='category'>",
                    "<tr id=title>",
                        "<th class='category-title'>#</th>",
                        "<th class='category-title'>Nom</th>",
                        "<th class='category-title'>Prix</th>",
                        "<th class='category-title'>Qté</th>",
                        "<th class='category-title'>Total</th>",
                        "<th class='category-title'>Action</th>",
                    "</tr>",
                "</thead>",
                "<tbody>";
                
        $totalGeneral = 0;
        $nbArticle = 0;

        foreach($_SESSION['products'] as $index => $product){

            echo "<tr id='product-hover'>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    //Number_format permet de modifier l'affichage d'une valeur numérique
                    "<td>".number_format($product['price'], 2,",","&nbsp;")."&nbsp;€</td>",
                    "<td id='categoryQtt'>"."<div>".$product['qtt']."</div>"."<div id='quantite'><a href='traitement.php?action=up-qtt&id=$index' uk-icon='triangle-up'></a>",
                    "<a href='traitement.php?action=down-qtt&id=$index' uk-icon='triangle-down'></a></div></td>",
                    "<td>".number_format($product['total'], 2,",","&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?action=delete&id=$index' class='icon' uk-icon='icon:close'></a></td>",
                "</tr>";

            $totalGeneral+= $product['total'];
          
            $_SESSION['nbArticles'] = $nbArticle+= $product['qtt'];
            
        }

        echo  "</tbody>",
        "</table>",
        "</div>",
        "<div id=total-container>",
            "<div id='article'>",
                "<span><strong>Total</strong></span>",
                "<span><strong>"." (".number_format($nbArticle, 0,"&nbsp;")." articles) :</strong></span>",
            "</div>",
            "<div id='total'>",
                "<span><strong>"."&nbsp;".number_format($totalGeneral, 2,",","&nbsp;")."&nbsp;€ &nbsp;</strong></span>",
            "</div>",
            "<div><a href='traitement.php?action=clear' class='icon_trash' uk-icon='icon:trash' ></a></div>",
        "</div>";

    }
    
    ?>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit-icons.min.js"></script>
</html>