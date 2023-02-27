<?php
$file = "02e1efe565501c3083a1fe6f53b35f36.png";
//recupere le chemin complet
$picture = __DIR__ . "/uploads/" . $file;
//recuper les info
$info = getimagesize($picture);

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
//pour effet mirroir l image
imageflip(
    $pictureSource,
    IMG_FLIP_HORIZONTAL
);

switch ($info["mime"]) {
    case "image/png":
        //on enregistre limage
        imagepng($pictureSource, __DIR__ . "/uploads/flips/flip-" . $file);
        break;

    case "image/jpeg":
        //on enregistre limage
        imagejpeg($pictureSource, __DIR__ . "/uploads/flips/flip-" . $file);
        break;

    case "image/webp":
        //on enregistre limage
        imagewebp($pictureSource, __DIR__ . "/uploads/flips/flip-" . $file);
        break;
}

//on detruit les image en memoire

imagedestroy($pictureSource);
