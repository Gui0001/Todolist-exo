<?php 

    require 'db.php';

    // Si on a sounis le form et inseré une valeur dans le champ alors 
    // on ajoute la todo à la DB
    if (isset($_POST['submit']) && !empty($_POST['todo'])) {
        $todo = htmlspecialchars($_POST['todo']);
        $sql = "INSERT INTO `todos` (title) VALUES ('$todo')";
        $pdo->exec($sql);
    } 

    // Si on a soumis le form sans remplir le champ on a une erreur
    if (isset($_POST['submit']) && empty($_POST['todo'])) {
        $err = "Vous devez remplir le champ !";
    }

    // On vient récupérer l'ensemble des todos dans une variable $todos
    // On récupère avec fetchAll toutes les lignes du tableau
    $sql = "SELECT * FROM `todos`";
    $todos = $pdo->query($sql)->fetchAll();


    // Si on retrouve bien dans l'URL ?delete=id alors on supprime la todo de la db
    if (!empty($_GET['delete'])) {
        $id = $_GET['delete'];
        $del = "DELETE FROM `todos` WHERE id=$id";
        $pdo->exec($del);
        header('location: index.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo PHP</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <h1>Ma TODO en PHP !</h1>

    <form method="POST">
        <label for="write-todo"></label>
        <input name="todo" type="text" id="write-todo" placeholder="ici votre Todo...">
        <input type="submit" name="submit" value="Soumettre Todo">
    </form>

    <?php if (isset($err)) : ?>
        <h3><?= $err ?></h3>
    <?php endif ?>

    <div class="todos-list">
        <?php foreach ($todos as $todo) : ?>
            <div class="todo">
                <a class='delete-btn' href="?delete=<?= $todo['id'] ?>">X</a>
                <p><?= $todo['title'] ?></p>
            </div>
        <? endforeach ?>
    </div>
    
</body>
</html>