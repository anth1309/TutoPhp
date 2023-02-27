<?php
$file = "02e1efe565501c3083a1fe6f53b35f36.png";
//recupere le chemin complet
$picture = __DIR__ . "/uploads/" . $file;
//recuper les info
$info = getimagesize($picture);

$width = $info[0];
$heigth = $info[1];


switch ($info["mime"]) {
    case "image/png":
        //on ouvre l image pngs
        $pictureSource = imagecreatefrompng($picture);
        break;

    case "image/jpeg":
        //on ouvre l image jpeg
        $pictureSource = imagecreatefromjpeg($picture);
        break;

    case "image/webp":
        //on ouvre l image wepb
        $pictureSource = imagecreatefromwebp($picture);
        break;
    default:
        die("le format d'image est incorrect");
}
//pour recadrer l image
$newPicture = imagecrop($pictureSource, [
    "x" => ($width / 2) - 250, //point de dep de la decoupe en px
    "y" => ($heigth / 2) - 150, //point de dep de la decoupe
    "width" => 500, //largeur en px qu il prd
    "height" => 300
]);

switch ($info["mime"]) {
    case "image/png":
        //on enregistre limage
        imagepng($newPicture, __DIR__ . "/uploads/crops/crop-" . $file);
        break;

    case "image/jpeg":
        //on enregistre limage
        imagejpeg($newPicture, __DIR__ . "/uploads/crops/crop-" . $file);
        break;

    case "image/webp":
        //on enregistre limage
        imagewebp($newPicture, __DIR__ . "/uploads/crops/crop-" . $file);
        break;
}

//on detruit les image en memoire
imagedestroy($pictureSource);
imagedestroy($newPicture);
