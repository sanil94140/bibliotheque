<?php

// On veut afficher la liste des trucs à vendre


/**
 * Etape 1 : connexion
 */
$bdd = new mysqli('localhost', 'root', '', 'bibliothèque');

if ($bdd->connect_errno != 0) {
    echo 'Impossible de se connecter à la BDD.';
    die();
}

/**
 * Etape 2 : Requête
 */
$requete = 'SELECT * FROM `livre`';
$reponse = $bdd->query($requete);

if ($reponse === false) {
    echo 'Problème lors de la requête.';
    die();
}

/**
 * Etape 3 : Lire la réponse
 */
$livre_a_lire = $reponse->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre Retrieve</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="/../index.php">Home</a></li>
            <li><a href="retrieve.php">Retrieve</a></li>
            <li><a href="create.php">Create</a></li>
        </ul>
    </nav>

    <h1>Retrieve</h1>

    <?php foreach ($livre_a_lire as $element) { ?>
        <h2><?php echo $element['titre']; ?></h2><br/><br/>
        <p>Numéro International normalisé (ISBN): <?php echo $element['isbn']?></p><br/>
        <p>Ecrit par: <?php echo $element['auteur_id']?></p><br/>
        <p>Publiée le: <?php echo $element['date_de_publication']?></p><br/>
        <p>Quantité disponible: <?php echo $element['stock']?></p><br/><br/>
    <?php } ?>
</body>

</html>