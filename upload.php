<?php
include_once "includes/header.php";
include_once "includes/navbar.php";
//on verifi si un fichier a ete envoyé
if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] === 0) {
    //on a l image, on verifi l extension et le type Mime
    $allowed = [
        "jpg" => "image/jpg",
        "jpeg" => "image/jpeg",
        "png" => "image/png"
    ];
    $filename = $_FILES["picture"]["name"];
    $filetype = $_FILES["picture"]["type"];
    $filesize = $_FILES["picture"]["size"];
    //recupere l extention
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    //on verif l abs de l extension ds $allowed ou l abs du type Mime
    if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
        die("Erreur: format de fichier");
    }
    //type est correct verif lim de taille(ex 1MO 1024*1024)
    if ($filesize > 4200 * 2000) {
        die("Fichier trop volumineux");
    }
    //generer un nom unique du fichier uploade puis le chemin
    $newname = md5(uniqid());
    $newfilename = __DIR__ . "/uploads/$newname.$extension";
    //on met le fichier ds uploads
    if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $newfilename)) {
        die("Le fichier n'a pas put être chargé");
    }
    chmod($newfilename, 0644);
    //protege contre l execution
    //unlink(__DIR__."/uploads/......extension");s
}
?>

<?php echo "<pre>";
var_dump($_FILES);
echo "</pre>"; ?>


<form method="post" enctype="multipart/form-data">
    <main class="container">
        <section class="row">
            <div class="col-12 my-3">
                <h1>Ajout des fichiers</h1>
                <div>
                    <label for="filePicture" class="form-label">FICHIER</label>
                    <input type="file" name="picture" id="filePicture" class="form-control my-3">
                </div>
                <button type="submit">Envoyer</button>
            </div>
        </section>
    </main>
</form>
<?php
include_once "includes/footer.php"
?>