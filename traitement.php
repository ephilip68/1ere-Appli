<?php

// Enregistre les produits en session sur le serveur
session_start();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

// Cela vérifiera si un ID a été envoyé grâce à "$_GET" et le stocke dans $id, sinon $id sera null
if(isset($_GET['action'])){

    switch($_GET['action']){
    case "add":  
        // Condition pour limiter l'accès au fichier traitement.php et que des utilisateurs mal intentionnés de puissent pas l'atteindre 
        //$_POST['submit'] -> Vérifie l'existence de la clé "submit" dans le tableau $_POST
        if(isset($_POST["submit"])){
        
            // La fonction filter_input() permet de valider ou nettoyer chaque donnée transmise par le formulaire en utilisant divers filtres
            // FILTER_SANITIZA_STRING supprime une chaîne de caractère de toute présence de caractères spéciaux et balise HTML potentielle ou encodes
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            // FILTER_VALIDATE_FLOAT permet de valider le prix que si il est un nombre à virgule
            // Le drapeau FILTER_FLAG_ALLOW_FRACTION permet l'utilisation du caractère "," ou "." pour la décimal
            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
            //FILTER_VALIDATE_INT validera la quantité que si celle-ci est un nombre entier différent de zéro
            $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
        
        
            // Maintenant les valeurs du formulaire validées ou nettoyées, cette nouvelle condition nous permet de vérifier si tous les filtres ont fonctionés
            if($name && $price && $qtt){
        
                // Construction d'un tableau associatif afin d'organiser les données qui permettront d'afficher nos produits plus tard
                $product = [

                    "name" => $name,
                    "price" => $price,
                    "qtt" => $qtt,
                    "total" => $price*$qtt,
                    "article" => $nbArticle
                    
                ];
        
                // Permet de stocker nos données en session en les ajoutant au tableau $_SESSION
                // [] indique à cette emplacement que nous ajoutons une nouvelle entrée au futur tableau "products" associé à cette clé
                // $_SESSION["product"] doit être également un tableau pour pouvoir stocker de nouveaux produits
                $_SESSION['products'][] = $product;
        
                $_SESSION['msg'] = "Votre produit à été ajouté avec succès";
                    
            }else {

                $_SESSION['msg'] = "erreur";

            }
        }

        header("Location:index.php");
    break;
    case "delete": unset($_SESSION['products'][$_GET['id']]);
            $_SESSION['msg'] = "Votre produit à été retiré du panier !";
        header("Location:recap.php");
        die;
    break; 
    case "clear": unset($_SESSION['products']);
            $_SESSION['msg'] = "Votre panier est vide !";
        header("Location:recap.php");
        die;
    break;
    case "up-qtt": $_SESSION['products'][$_GET['id']]['qtt']++;
        header("Location:recap.php");
        die;
    break;
    case "down-qtt": $_SESSION['products'][$_GET['id']]['qtt']--;
        header("Location:recap.php");
        die;
    break;
    }

}

// La fonction header effectue une redirection 
// ("location") envoie un nouvel entête HTTP au client avec le statut code 302 qui indique une redirection

    header("Location:index.php");



// definir: 

/* session =  Démarre une session sur le serveur ou récupère la session de l'utilisateur s'il en avait déja une.
              Au démarage le serveur enregistre un cookie PHPSESSID dans le navigateur client, contenant l'identifiant de la session lui appartenant .
              Le but des sessions n'est pas de conserver les informations indéfiniment mais simplement durant une session, Une session démarre dès que la fonction session_start() est appelée et se termine en général dès que la fenêtre courante du navigateur est fermée.
              La durée de vie du cookie dépend de la configuration serveur à ce sujet. Par défaut, la session expiera à la fermeture du navigateur.
 
supergables = Ce sont des variables de type tableau qui propose une manière simple d'y regrouper plusieurs informations sous forme de paires"clé/valeur".
              Ces variables sont disponibles dans nimporte quel script PHP et sont crées automatiquement par le serveur mais peuvent être vide.

teableau associatif = C'est un tableau qui utilise des clé textuelles qu'on associe à chaque valeur. il se présente sous la forme de paires "clé/valeur".
*/