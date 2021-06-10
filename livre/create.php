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

    <h1>Création du livre</h1>

    <form action="create-handler.php" method="POST">
        <label for="titre">titre</label>
        <input type="text" name="titre" id="titre" required autofocus>
        <br>

        <label for="isbn">isbn</label>
        <input type="text" name="isbn" id="isbn" required>
        <br>

        <label for="nom_auteur">Nom de l'auteur</label>
        <input type="text" name="nom_auteur" id="nom_auteur" required>
        <br>
        <label for="prenom_auteur">Préom de l'auteur</label>
        <input type="text" name="prenom_auteur" id="prenom_auteur" required>
        <br>
        <label for="stock">Stock disponible</label>
        <input type="number" name="stock" id="stock" required>
        <br>

        <input type="hidden" name="date_de_publication" id="date_de_publication" value=<?php echo time(); ?>>
        <br>

        <input type="submit" value="Envoyer">
    </form>
</body>

</html>