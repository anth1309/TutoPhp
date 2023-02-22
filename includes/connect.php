
<?php
//cste d environement
define("DBHOST", "localhost");
define("DBUSER", "anthony");
define("DBPASS", "chambon");
define("DBNAME", "test_techno");
//pour pdo un dsn de conexion

$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

//se connecter a la dbd

try {
    //on instancie PDO
    $db = new PDO($dsn, DBUSER, DBPASS);
    //on sassure d envoyer les donnees en utf 8
    $db->exec("SET NAMES utf8");
    //on def le mode de fetch par defaut pour les requetes ulterieur
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERREUR : " . $e->getMessage());
}
