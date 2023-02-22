<?php
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
//on traite le formulaire
if (!empty($_POST)) {
    //post n est pas vide donc verif toutes les données sont presente

    if (
        isset($_POST["title"], $_POST["content"]) &&
        !empty($_POST["title"]) &&
        !empty($_POST["content"])
    ) {
        //le form est complet on recupere les données enles protégeant
        //on retire toute balise du titre
        $titre = strip_tags($_POST["title"]);
        //on neutralise toute les balises du contenu
        $content = htmlspecialchars($_POST["content"]);
        //on les enregistre on se connecte a la bdb
        require_once "../../includes/connect.php";
        $sql = "INSERT INTO `articles`  (`title`,`content`) VALUES(:title, :content)";
        $query = $db->prepare($sql);

        //on injecte les valeurs
        $query->bindValue(":title", $titre, PDO::PARAM_STR);
        $query->bindValue(":content", $content, PDO::PARAM_STR);

        if (!$query->execute()) {
            die("L'article ne peut pas être ajouter");
        } else {
            //on recupere l id de larticle
            $id = $db->lastInsertId();
            die("Article ajouté avec succés sous le numéro $id");
        }
    } else {
        die("le formulaire est incomplet");
    }
}

$titre = "Ajout d'article";
include_once "../../includes/header.php";
include_once "../../includes/navbar.php" ?>
<main class="container">
    <section class="row">

        <div class="col-12 ">
            <form action="" method="post" class="my3">
                <div class="my-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>

                <div class="my-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea name="content" id="content" class="form-control"></textarea>
                </div>
                <button type="submit" class="my-3">Soumettre</button>
            </form>
        </div>
        <section>
</main>
<?php
include_once "../../includes/footer.php";
?>