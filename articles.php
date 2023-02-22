<?php
require_once "includes/connect.php";
$sql = "SELECT * FROM `articles` ORDER BY `created_at` ASC ";
//on execute la requete
$query = $db->query($sql);
//on recupere les données
$articles = $query->fetchAll();

$titre = 'Articles';
include_once "includes/header.php";
include_once "includes/navbar.php";
?>

<p>
<h1>Bienvenue sur la page des articles</h1>
<h2>Liste des articles</h2>
</p>
<section>
    <?php foreach ($articles as $article) :  ?>
        <main class="container ">
            <section class="row">
                <div class="col-12 ">
                    <article class="my-4">

                        <h3>TITRE :</h3>
                        <h4><a href="article.php?id=<?= $article["id"] ?>">
                                <?= strip_tags($article["title"]) //strips_tags protege le code
                                ?>
                            </a></h4>

                        <p>
                        <h5>L'article a été créer le : </h5><?= strip_tags($article["created_at"]) ?></p>
                        <div>
                            <h5>ARTICLE</h5> <?= strip_tags($article["content"]) ?>
                        </div>

                    </article>
                </div>
            </section>
        </main>
    <?php
    endforeach; ?>
</section>

<?php
include_once "includes/footer.php";

?>