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
    !empty($_POST['nom_emprunteur'])
    && !empty($_POST['prenom_emprunteur'])
    && !empty($_POST['titre_livre'])
    && $_POST['date_retour']!=date('Y-m-d') 
    && $_POST['date_retour']>date('Y-m-d')
    // && is_numeric($_POST['stock'])
    // && is_numeric($_POST['stock'])
) {


    //////////////////////////////////////////////////////////////////////////////
    $requete = 'SELECT * FROM `personne`';
    $reponse = $bdd->query($requete);
    
    if ($reponse === false) {
        echo 'Problème lors de la requête.';
        die();
    }
    
    
    $personne = $reponse->fetch_all(MYSQLI_ASSOC);
    $id_personne=0;
    foreach ($personne as $element){
        if($element['nom']==$_POST['nom_emprunteur'] && $element['prenom']==$_POST['prenom_emprunteur']){
            $id_personne=$element['id'];
            break;
        }
    }
    if($id_personne==0){
        echo 'Le nom de l\'emprunteur que vous avez indiqué n\'existe pas dans notre base de données';
        echo '<nav>';
        echo '<ul>';
            echo '<li><a href="retrieve.php">Retourner dans le Retrieve </a></li>';
            echo '<li><a href="create.php">Tenter de créer un nouveau emprunt</a></li>';
        echo '</ul>';
        echo '</nav>';
        die();
    }


    //////////////////////////////////////////////////////////////////////////////
    $requete = 'SELECT * FROM `livre`';
    $reponse = $bdd->query($requete);
    
    if ($reponse === false) {
        echo 'Problème lors de la requête.';
        die();
    }
    
    
    $livre = $reponse->fetch_all(MYSQLI_ASSOC);
    $id_livre=0;
    foreach ($livre as $element){
        if($element['titre']==$_POST['titre_livre']){
            $id_livre=$element['id'];
            break;
        }
    }
    if($id_livre==0){
        echo 'Le nom du livre que vous avez indiqué n\'existe pas dans notre base de données';
        echo '<nav>';
        echo '<ul>';
            echo '<li><a href="retrieve.php">Retourner dans le Retrieve </a></li>';
            echo '<li><a href="create.php">Tenter de créer un nouveau emprunt</a></li>';
        echo '</ul>';
        echo '</nav>';
        die();
    }
    //////////////////////////////////////////////////////////////////////////////////////

    
    // On insère notre truc à vendre dans la table
    $requete = 'INSERT INTO `emprunt` 
        VALUES (
            NULL, 
            \'' . $id_personne . '\', '
            . $id_livre . ', '
            .date('Y-m-d'). ', '
            . $_POST['date_retour'] .
        ')';

    /**
     * Etape 2 : Envoyer la requête
     */
    $reponse = $bdd->query($requete);

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
