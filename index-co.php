<?php 

require 'db.php';

// 1) Si on a soumis le form et bien rempli le champ on veut ajouter une todo
// à la BDD
    if (!empty($_POST['todo']) && isset($_POST['submit'])) {
        $todo = htmlspecialchars($_POST['todo']);
        $sql = "INSERT INTO todos (title) VALUES ('$todo')";
        $pdo->exec($sql);
    }


// 2) Si notre forme est vide on veut afficger une erreur
    if (isset($_POST['submit']) && empty($_POST['todo'])) {
        $err = "Vous devez remplir le champ !";
    }

// 3) Notre bouton de suppression
    if (!empty($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM todos WHERE id=$id";
        $pdo->exec($sql);
        header('location: index.php');
    }


// Afficher l'ensemble des todos (si elles existent)
    $sql = 'SELECT * FROM todos';
    $todos = $pdo->query($sql)->fetchAll();

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
        <input name="todo" type="text" id="write-todo" placeholder="ici votre Todo...">
        <input type="submit" name="submit" value="Soumettre Todo">
    </form>

    <?php if (isset($err)) : ?>
        <h3><?= $err ?></h3>
    <?php endif ?>

    <div class="todos-list">
        <?php foreach ($todos as $todo) : ?>
            <div class="todo">
                <a class='delete-btn' href="?delete=<?=$todo['id']?>">X</a>
                <p><?= $todo['title'] ?></p>
            </div>
        <?php endforeach ?>
    </div>

</body>
</html>