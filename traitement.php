<?php

// Enrgistre les produits en session sur le serveur
session_start();

// Condition pour limiter l'accès au fichier traitement.php et que des utilisateurs mal intentionnés de puissent pas l'atteindre 
//$_POST['submit'] -> Vérifie l'existence de la clé "submit" dans le tableau $_POST
if(isset($_POST["submit"])){

    // La fonction filter_input() permet de valider ou nettoyer chaque donnée transmise par le formulaire en utilisant divers filtres
    // FILTER_SANITIZA_STRING supprime une chaîne de caractère de toute présence de caractères spéciaux et balise HTML potentielle ou encodes
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // FILTER_VALIDATE_FLOAT permettra de valider le prix que si il est un nombre à virgule
    // Le drapeau FILTER_FLAG_ALLOW_FRACTION permet l'utilisation du caractère "," ou "." pour la décimal
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    //FILTER_VALIDATE_INT validera la quantité que si celle-ci est un nombre entier différent de zéro
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);


    // Maintenant les valeurs du formulaire validées ou nettoyées, cette nouvelle condition nous permettra de vérifier si tous les filtres ont fonctionés
    if($name && $price && $qtt){

        // Construction d'un tableau associatif afin d'organiser les données qui permettront d'afficher nos produits plus tard
        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price*$qtt
        ];

        // Permet de stocker nos données en session en les ajoutant au tableau $_SESSION
        // [] indique à cette emplacement que nous ajoutons une nouvelle entrée au futur tableau "products" associé à cette clé
        // $_SESSION["product"] doit être également un tableau pour pouvoir stocker de nouveaux produits
        $_SESSION['products'][] = $product;

    }

}

// La fonction header effectue une redirection 
// ("location") envoie un nouvel entête HTTP au client avec le statut code 302 qui indique une redirection
header("Location:index.php");

