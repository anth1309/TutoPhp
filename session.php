<?php
session_start();
echo "<pre>";
var_dump($_SESSION["panier"]);
echo "</pre>";
$_SESSION["panier"] = [
    "produit" => [
        "collier", "bracelet", "perles"
    ],
    "quantité" => [
        10, 15, 2
    ],
    "prix" => [
        12, 5, 5
    ],
];
