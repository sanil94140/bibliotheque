<?php
    /**
     * Etape 1 : Connexion
     */
    $bdd = new mysqli('localhost', 'root', '', 'bibliothèque');

    if ($bdd->connect_errno != 0) {
        echo 'Impossible de se connecter à la BDD.';
        die();
    }


    // On vérifie le contenu du formulaire
if (
    !empty($_POST['titre'])
    && !empty($_POST['isbn'])
    && !empty($_POST['nom_auteur'])
    && !empty($_POST['prenom_auteur'])
    && !empty($_POST['stock'])

    && is_numeric($_POST['stock'])
    // && is_numeric($_POST['stock'])
) {

    $requete = 'SELECT * FROM `auteur`';
    $reponse = $bdd->query($requete);
    
    if ($reponse === false) {
        echo 'Problème lors de la requête.';
        die();
    }
    
    
    $auteur = $reponse->fetch_all(MYSQLI_ASSOC);
    $id_auteur=0;
    foreach ($auteur as $element){
        if($element['nom']==$_POST['nom_auteur'] && $element['prenom']==$_POST['prenom_auteur']){
            $id_auteur=$element['id'];
            break;
        }
    }
    if($id_auteur==0){
        echo 'L\'auteur que vous avez indiqué n\'existe pas dans notre base de données';
        echo '<nav>';
        echo '<ul>';
            echo '<li><a href="retrieve.php">Retourner dans le Retrieve </a></li>';
            echo '<li><a href="create.php">Ajouter un nouveau livre</a></li>';
        echo '</ul>';
        echo '</nav>';
        die();
    }
    // On insère notre truc à vendre dans la table
    $requete2 = 'INSERT INTO `livre` 
        VALUES (
            NULL, 
            \'' . $_POST['titre'] . '\', '
            . $_POST['isbn'] . ', '
            .$id_auteur. ', '
            . $_POST['stock'] . ', '
            . $_POST['date_de_publication'] .
        ')';

    /**
     * Etape 2 : Envoyer la requête
     */
    $reponse = $bdd->query($requete2);

    if ($reponse === false) {
        echo 'Problème pendant l\'insertion.';
        die();
    } else {
        // L'insertion a réussi
        // On redirige
        header('location: retrieve.php');
    }
} else {
    echo 'Erreur de saisie du formulaire.';
    die();
}
