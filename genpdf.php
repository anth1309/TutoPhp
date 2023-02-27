<?php

use Dompdf\Dompdf;
use Dompdf\Options;

include_once "includes/connect.php";

$sql = 'SELECT * FROM `users`';
$query = $db->query($sql);
$users = $query->fetchAll();
//permet de stocker dans une variable
ob_start();
require_once "pdf-content.php";

$html = ob_get_contents();
ob_end_clean();
//on genere un fichier html qui contient le resultat

require_once "includes/dompdf/autoload.inc.php";
//option ex police facultatif
$options = new Options();
$options->set('defaultFont', 'Courier');

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');


$dompdf->render();
$file = 'pdf de Moi';
$dompdf->stream($file);
