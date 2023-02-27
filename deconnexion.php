<?php
session_start();
//supprimer la variable
unset($_SESSION["user"]);
header("location: index.php");
