<?php
if (!empty($_POST)) {

    if (
        isset($_POST["email"], $_POST["password"]) &&
        !empty($_POST["email"]) && !empty($_POST["password"])
    ) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die('Ce n est pas un email');
        }
        require_once "includes/connect.php";
        $sql = "SELECT * FROM `users` WHERE `email`= :email";
        $query = $db->prepare($sql);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        if (!$user) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }
        if (!password_verify($_POST["password"], $user["password"])) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }
    }
}
include_once "includes/header.php";
include_once "includes/navbar.php"; ?>

<h1>Conexion</h1>
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
include_once "includes/footer.php";

?>