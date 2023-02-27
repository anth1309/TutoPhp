<?php

use Dompdf\Dompdf;
use Dompdf\Options;



require_once "pdf-content.php";
die;
//on genere un fichier html qui contient le resultat

require_once "includes/dompdf/autoload.inc.php";
//option ex police facultatif
$options = new Options();
$options->set('defaultFont', 'Courier');

$dompdf = new Dompdf($options);

$dompdf->loadHtml('riendutout mais c est un debut');

$dompdf->setPaper('A4', 'portrait');


$dompdf->render();
$file = 'pdf de Moi';
$dompdf->stream($file);