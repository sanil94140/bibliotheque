<?php

// On veut un id dans l'URL ($_GET['id'])
if (empty($_GET['id'])) {
    echo 'Mauvaise URL.';
    die();
}

$requete = 'DELETE FROM `livre` WHERE `id` = ' . $_GET['id'];

/**
 * Etape 1 : Connexion
 */
$bdd = new PDO('mysql:host=localhost;dbname=bibliothèque', 'root', '');

/**
 * Etape 2 : Envoyer la requête
 */
$reponse = $bdd->query($requete);

if ($reponse === false) {
    echo 'Il y a eu un souci pendant la requête.';
    die();
}

header('location: retrieve.php');
