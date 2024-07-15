<?php

// data source name
$dsn = "mysql:dbname=test;host=localhost:3300"; 
$username = "root"; 
$password = "";
$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

// Connexion à la BDD avec PDO
try {

    $pdo = new PDO($dsn, $username, $password, $options);

    // echo "Connexion réussie<br><br>";

} catch (PDOException $error) {

    die("Il y a une erreur : " . $error . "<br>");

}
