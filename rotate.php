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
//pour tourner l image
$newPicture = imagerotate($pictureSource, 45, 0);

switch ($info["mime"]) {
    case "image/png":
        //on enregistre limage
        imagepng($newPicture, __DIR__ . "/uploads/rotates/rotate-" . $file);
        break;

    case "image/jpeg":
        //on enregistre limage
        imagejpeg($newPicture, __DIR__ . "/uploads/rotates/rotate-" . $file);
        break;

    case "image/webp":
        //on enregistre limage
        imagewebp($newPicture, __DIR__ . "/uploads/rotates/rotate-" . $file);
        break;
}

//on detruit les image en memoire

imagedestroy($newPicture);
