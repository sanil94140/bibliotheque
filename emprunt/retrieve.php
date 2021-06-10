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
$requete_emprunt = 'SELECT * FROM `emprunt`';
$reponse_emprunt = $bdd->query($requete_emprunt);

if ($reponse_emprunt === false) {
    echo 'Problème lors de la requête.';
    die();
}



/**
 * Etape 3 : Lire la réponse
 */
$emprunt_tableau = $reponse_emprunt->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunt Retrieve</title>
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

    <a style="width=100%" href='create.php'>Créer un nouveau emprunt</a>
    <?php foreach ($emprunt_tableau as $element) { ?>
        <?php

            $requete_personne = 'SELECT * FROM `personne` WHERE `id`='.$element['abonne'];
            $reponse_personne = $bdd->query($requete_personne);

            if ($reponse_personne === false) {
                echo 'Problème lors de la requête.';
                die();
            }
            $personne_tableau = $reponse_personne->fetch_all(MYSQLI_ASSOC);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $requete_role = 'SELECT * FROM `role` WHERE `id`='.$personne_tableau[0]["role_id"];
            $reponse_role = $bdd->query($requete_role);

            if ($reponse_role === false) {
                echo 'Problème lors de la requête.';
                die();
            }
            $role_tableau = $reponse_role->fetch_all(MYSQLI_ASSOC);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $requete_livre = 'SELECT * FROM `livre` WHERE `id`='.$element['livre'];
            $reponse_livre = $bdd->query($requete_livre);

            if ($reponse_livre === false) {
                echo 'Problème lors de la requête.';
                die();
            }
            $livre_tableau = $reponse_livre->fetch_all(MYSQLI_ASSOC);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $requete_auteur = 'SELECT * FROM `auteur` WHERE `id`='.$livre_tableau[0]["auteur_id"];
            $reponse_auteur = $bdd->query($requete_auteur);

            if ($reponse_auteur === false) {
                echo 'Problème lors de la requête.';
                die();
            }
            $auteur_tableau = $reponse_auteur->fetch_all(MYSQLI_ASSOC);
            /////////////////////////////////////////////////////////////////////////////////////
        ?>

        <h2><?php echo 'Emprunt du livre: '.$livre_tableau[0]['titre']; ?></h2><br/><br/>
        <p>Personne ayant emprunté ce livre: <b><?php echo $personne_tableau[0]['nom']?></b> <i><?php echo $personne_tableau[0]['prenom'] ?></i></p>
        <p>Rôle de l'emprunteur: <?php echo $role_tableau[0]['nom']?></p>
        <p>Date d'emprunt: <?php echo $element['date_emprunt']?></p>
        <p>A retourner avant le: <?php echo $element['date_retour']?></p>
        <p>Nom de l'auteur: <b><?php echo $auteur_tableau[0]['nom']?></b> <i><?php echo $auteur_tableau[0]['prenom'] ?></i></p><br/><br/>

            <a href="update.php?id=<?php echo $element['id']; ?>">Modifier</a>
            <a href="delete.php?id=<?php echo $element['id']; ?>">Supprimer</a>
        </p><br/><br/>
    <?php } ?>
</body>

</html>