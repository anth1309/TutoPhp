<?php
$file = "5ba36edcfd9914af526b1445f3d9b300.png";
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
        //var_dump($pictureSource);
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
//on ouvre le logo
$mark = imagecreatefrompng(__DIR__ . "/uploads/images.png");
//var_dump($mark);
$infoMark = getimagesize(__DIR__ . "/uploads/images.png");
var_dump($infoMark);
//on copie tout l image src ds l img de destination
imagecopyresampled(
    $pictureSource, //destination
    $mark, //source
    $info[0] - $infoMark[0] - 10, //pos x coin supG ds l img desti
    $info[1] - $infoMark[1] - 10, //pos y coin supV ds l img desti
    0, //pos x coin supV de l img src
    0, //pos y coin supV de l img src
    $infoMark[0], //largeur ds l img de destina
    $infoMark[1], //hauteur ds l img de destina
    $infoMark[0], //hauteur ds l img de src
    $infoMark[1], //hauteur ds l img de src
);

//on enregistre la new img ds la meme
switch ($info["mime"]) {
    case "image/png":
        //on enregistre limage
        imagepng($pictureSource, __DIR__ . "/uploads/watermarks/watermark-" . $file);
        break;

    case "image/jpeg":
        //on enregistre limage
        imagejpeg($pictureSource, __DIR__ . "/uploads/watermarks/watermark-" . $file);
        break;

    case "image/webp":
        //on enregistre limage
        imagewebp($pictureSource, __DIR__ . "/uploads/watermarks/watermark-" . $file);
        break;
}

//on detruit les image en memoire
imagedestroy($mark);
imagedestroy($pictureSource);