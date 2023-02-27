<?php
session_start();
include_once "includes/header.php";
include_once "includes/navbar.php"; ?>

<main class="container"></main>
<section class="row">
    <div class="col-12 my-3">
        <h1>PROFIL DE : <?php
                        echo  ucfirst($_SESSION["user"]["prenom"])
                        ?></h1>
        <?php echo "<pre>";
        var_dump($_SESSION);
        var_dump($_SESSION["panier"]);
        echo "</pre>"; ?>
        <p>Pseudo : <?= ucfirst($_SESSION["user"]["pseudo"]) ?> </p>
        <p>Courriel : <?= $_SESSION["user"]["email"] ?></p>
        <p>Vous êtes identifié sous le num : <?= $_SESSION["user"]["id"] ?></p>
        <p>Vous avez un role : <?= $_SESSION["user"]["rol"] ?></p>



    </div>
</section>
</main>



<?php
include_once "includes/footer.php";

?>