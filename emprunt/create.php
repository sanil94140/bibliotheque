<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="retrieve.php">Retrieve</a></li>
            <li><a href="create.php">Create</a></li>
        </ul>
    </nav>

    <h1>Création d'un emprunt</h1>

    <form action="create-handler.php" method="POST">
        <label for="nom_emprunteur">Nom de l'emprunteur</label>
        <input type="text" name="nom_emprunteur" id="nom_emprunteur" required autofocus>
        <br>
        <label for="prenom_emprunteur">Prenom de l'emprunteur</label>
        <input type="text" name="prenom_emprunteur" id="prenom_emprunteur" required autofocus>
        <br>
        <label for="titre_livre">Titre du livre à emprunter</label>
        <input type="text" name="titre_livre" id="titre_livre" required autofocus>
        <br>

        <label for="start">Date de retour:</label>
        <input type="date" id="start" name="date_retour" value=<?php echo date('Y-m-d'); ?>><br/>

        <input type="submit" value="Envoyer">
    </form>
</body>

</html>