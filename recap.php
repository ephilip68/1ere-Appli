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
    <title>Récapitulatif des produits</title>
</head>
<body>
<h2>recap</h2>

    <?php 
    
    // Soit clé 'product' du tableau $_SESSION n'existe pas "!isset()" soit cette clé existe mais est vide "empty()"
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){

        // Afichera donc à l'utilisateur un message lui disant qu'aucun produit existe en session
        echo "<p>Aucun produit en session...</p>";

    } else{
        // Affichera nos produits dans un tableau HTML
        echo "<table>",
                "<thead>",
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

        foreach($_SESSION['products'] as $index => $product){

            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    //Number_format permet de modifier l'affichage d'une valeur numérique
                    "<td>".number_format($product['price'], 2,",","&nbsp;")."&nbsp;€</td>",
                    "<td>".$product['qtt']."</td>",
                    "<td>".number_format($product['total'], 2,",","&nbsp;")."&nbsp;€</td>",
                 "</tr>";
            $totalGeneral+= $product['total'];
        }

        echo "<tr>"
                "<td colspan=4>Total général : </td>",
                "<td><strong>".number_format($totalGeneral, 2,",","&nbsp;")."&nbsp;€</strong></td>",
             "</tr>"
            "</body>",
        "</table>";
    
    }
    
    ?>
</body>
</html>