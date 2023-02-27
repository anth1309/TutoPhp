<?php

if (!empty($_POST)) {

    if (
        isset($_POST["email"], $_POST["password"]) &&
        !empty($_POST["email"]) && !empty($_POST["password"])
    ) {
        $_SESSION["errorConexion"] = [];
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["errorConexion"][] = "Ceci n est pas un courriel valide";
            //die("hh");
        }
        if ($_SESSION["errorConexion"] === []) {
            require_once "includes/connect.php";
            $sql = "SELECT * FROM `users` WHERE `email`= :email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();

            if (!$user) {
                $_SESSION["errorConexion"][] = "L'utilisateur et/ou le mot de passe est incorrect";
                //die("hh");
            }
            if (!password_verify($_POST["password"], $user["password"])) {
                $_SESSION["errorConexion"][] = "L'utilisateur et/ou le mot de passe est incorrect";
                // die("hh");
            }
        }
        //ouverture de la session

        //on stock ds $session les info du user
        if ($_SESSION["errorConexion"] === []) {
            session_start();
            $_SESSION["user"] = [
                "id" => $user["id"],
                "prenom" => $user["firstname"],
                "pseudo" => $user["nick"],
                "email" => $user["email"],
                "rol" => $user["roles"]
            ];
            header("location: profil.php");
        }
    }
}
include_once "includes/header.php";
include_once "includes/navbar.php"; ?>


<h1>Connexion</h1>
<form method="post">
    <main class="container">
        <section class="row">
            <div class="col-12 my-3">
                <div>
                    <label for="email" class="form-label">Courriel</label>
                    <input type="email" name="email" id="email" placeholder="exemple@gmail.com" class="form-control my-3">
                </div>
                <div>
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control my-3">
                </div>
                <div>
                    <button type="submit" class="col-12  my-3">Se connecter</button>
                </div>
            </div>
        </section>
    </main>
</form>


<?php
if (isset($_SESSION["errorConexion"])) {
    foreach ($_SESSION["errorConexion"] as $message) {
?>
        <p><?= $message ?></p>
<?php
    }
    unset($_SESSION["errorConexion"]);
}
?>



<?php
include_once "includes/footer.php";

?>