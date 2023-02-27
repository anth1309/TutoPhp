<?php
$file = "02e1efe565501c3083a1fe6f53b35f36.png";
$picture = __DIR__ . "/uploads/" . $file;
$info = getimagesize($picture);

$width = $info[0];
$heigth = $info[1];

//voir si l img est potrait ou image
switch ($width <=> $heigth) {
    case -1:
        $sizeSquare = $width;
        $src_x = 0;
        $src_y = ($heigth - $width) / 2;
        break;
    case 0:
        $sizeSquare = $width;
        $src_x = 0;
        $src_y = 0;
        break;
    case 1:
        $sizeSquare = $heigth;
        $src_x =  ($width - $heigth) / 2;
        $src_y = 0;
        break;
}

$newPicture = imagecreatetruecolor(200, 200);
switch ($info["mime"]) {
    case "image/png":
        $pictureSource = imagecreatefrompng($picture);
        break;
    case "image/jpeg":
        $pictureSource = imagecreatefromjpeg($picture);
        break;
    case "image/webp":
        $pictureSource = imagecreatefromwebp($picture);
        break;
    default:
        die("le format d'image est incorrect");
}

imagecopyresampled(
    $newPicture, //destination
    $pictureSource, //source
    0, //pos x coin supG ds l img desti
    0, //pos y coin supV ds l img desti
    $src_x, //pos x coin supV de l img src
    $src_y, //pos y coin supV de l img src
    200, //largeur ds l img de destina
    200, //hauteur ds l img de destina
    $sizeSquare, //hauteur ds l img de src
    $sizeSquare, //hauteur ds l img de src
);

switch ($info["mime"]) {
    case "image/png":
        imagepng($newPicture, __DIR__ . "/uploads/resizesquares/resizesquare-" . $file);
        break;
    case "image/jpeg":
        imagejpeg($newPicture, __DIR__ . "/uploads/resizesquares/resizesquare-" . $file);
        break;
    case "image/webp":
        imagewebp($newPicture, __DIR__ . "/uploads/resizesquares/resizesquare-" . $file);
        break;
}
imagedestroy($pictureSource);
imagedestroy($newPicture);