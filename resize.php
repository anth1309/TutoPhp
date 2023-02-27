<?php
$file = "401d1591d786252da6edd884c6c40658.jpg";
//recupere le chemin complet
$picture = __DIR__ . "/uploads/" . $file;
//recuper les info
$info = getimagesize($picture);

var_dump($info);
$width = $info[0];
$heigth = $info[1];

//on cre un nvlle image en mem
$newPicture = imagecreatetruecolor($width / 15, $heigth / 15);
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
//on copie tout l image src ds l img de destination
imagecopyresampled(
    $newPicture, //destination
    $pictureSource, //source
    0, //pos x coin supG ds l img desti
    0, //pos y coin supV ds l img desti
    0, //pos x coin supV de l img src
    0, //pos y coin supV de l img src
    $width / 15, //largeur ds l img de destina
    $heigth / 15, //hauteur ds l img de destina
    $width, //hauteur ds l img de src
    $heigth, //hauteur ds l img de src
);

//on enregistre la new img ds le serveur
switch ($info["mime"]) {
    case "image/png":
        //on enregistre limage
        imagepng($newPicture, __DIR__ . "/uploads/resizes/resize-" . $file);
        break;

    case "image/jpeg":
        //on enregistre limage
        imagejpeg($newPicture, __DIR__ . "/uploads/resizes/resize-" . $file);
        break;

    case "image/webp":
        //on enregistre limage
        imagewebp($newPicture, __DIR__ . "/uploads/resizes/resize-" . $file);
        break;
}

//on detruit les image en memoire
imagedestroy($pictureSource);
imagedestroy($newPicture);
