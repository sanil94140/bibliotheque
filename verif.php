<?php
$bdd = new mysqli('localhost', 'root', '', 'bibliothèque');
if ($bdd->connect_errno != 0) {
    echo 'Impossible de se connecter à la BDD.';
    die();
}

$requete = 'SELECT * FROM `livre`';
$reponse = $bdd->query($requete);

if ($reponse === false) {
    echo 'Problème lors de la requête.';
    die();
}


$livre_a_lire = $reponse->fetch_all(MYSQLI_ASSOC);
?>
<pre>
<?php print_r($livre_a_lire); ?>
</pre>
<?php
$requete = 'SELECT * FROM `auteur`';
$reponse = $bdd->query($requete);

if ($reponse === false) {
    echo 'Problème lors de la requête.';
    die();
}


$auteur = $reponse->fetch_all(MYSQLI_ASSOC);
?>
<pre>
<?php print_r($auteur); ?>
</pre>


<?php var_dump($auteur[0]['nom'], $auteur[0]['prenom']); ?>

