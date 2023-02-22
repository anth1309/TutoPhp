<?php
require_once "includes/connect.php";
//on verifie si on a un id
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    //je n ai pas d id
    header("Location: articles.php");
    exit;
}
//je recupere l id
$id = $_GET["id"];
//on va chercher l article ds bdd  fait la requete
$sql = "SELECT * FROM `articles` WHERE `id`= :id";
$query = $db->prepare($sql);
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->execute();

$article = $query->fetch();
//on verifie si l article est vide
if (!$article) {
    http_response_code(404);
    echo "L article n existe pas";
    exit;
}
//on a un article
$titre = strip_tags($article["title"]);



include_once "includes/header.php";
include_once "includes/navbar.php";
//on ecrit le contenu de la page
?>

<article>

    <h1>
        <?= strip_tags($article["title"]) //strips_tags protege le code
        ?>
    </h1>

    <p>
    <h3>L'article a été créer le : </h3><?= strip_tags($article["created_at"]) ?></p>
    <div>
        <h3>ARTICLE :</h3> <?= strip_tags($article["content"]) ?>
    </div>
</article>




<?php
include_once "includes/footer.php";

?>