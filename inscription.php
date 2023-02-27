<?php
session_start();
if (!empty($_POST)) {

    if (
        isset($_POST["nick"], $_POST["name"], $_POST["firstname"], $_POST["email"], $_POST["password"]) &&
        !empty($_POST["nick"]) && !empty($_POST["name"]) && !empty($_POST["firstname"]) && !empty($_POST["email"]) && !empty($_POST["password"])
    ) {
        $nick = htmlspecialchars($_POST["nick"]);
        $name = htmlspecialchars($_POST["name"]);
        $firstname = htmlspecialchars($_POST["firstname"]);
        $_SESSION["error"] = [];
        if (strlen($nick) < 4) {
            $_SESSION["error"][] = "le pseudo doit faire plus de 4 caractéres";
        }

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "le courriel est invalide";
        }

        if ($_SESSION["error"] === []) {

            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            require_once "includes/connect.php";
            $sql = "INSERT INTO `users` (`email`,`roles`,`password`,`nick`,`firstname`,`name`) VALUE (:email, '[\"ROLE_USER\"]','$password',:nick,:firstname,:name)";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->bindValue(":nick", $nick, PDO::PARAM_STR);
            $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $query->bindValue(":name", $name, PDO::PARAM_STR);
            $query->execute();

            //recuperation de l id du new user
            $id = $db->lastInsertId();

            session_start();
            $_SESSION["user"] = [
                "id" => $id,
                "pseudo" => $nick,
                "email" => $_POST["email"],
                "rol" => ["ROLE_USER"]
            ];

            header("location: profil.php");
        }
    } else {
        $_SESSION["error"] = ["Le formulaire est incomplet"];
    }
}
include_once "includes/header.php";
include_once "includes/navbar.php"; ?>

<h1>Inscription</h1>

<?php
if (isset($_SESSION["error"])) {
    foreach ($_SESSION["error"] as $message) {
?>
        <p><?= $message ?></p>
<?php
    }
    unset($_SESSION["error"]);
}
?>


<form method="post">
    <main class="container">
        <section class="row">
            <div class="col-12 my-3">
                <div>
                    <label for="nick" class="form-label">Pseudo</label>
                    <input type="text" name="nick" id="nick" placeholder="Votre pseudo" class="form-control my-3">
                </div>
                <div>
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" id="name" placeholder="Votre nom" class="form-control my-3">
                </div>
                <div>
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Votre prénom" class="form-control my-3">
                </div>
                <div>
                    <label for="email" class="form-label">Courriel</label>
                    <input type="text" name="email" id="email" placeholder="exemple@gmail.com" class="form-control my-3">
                </div>
                <div>
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control my-3">
                </div>
                <div>
                    <button type="submit" class="col-12  my-3">S'inscrire</button>
                </div>


            </div>
        </section>
    </main>
</form>






<?php
include_once "includes/footer.php";

?>