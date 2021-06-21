<?php
require_once '../Model/mypdf.php';
require_once '../lib/fpdf.php';
require_once '../lib/phpqrcode/qrlib.php';


session_start();


$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 30);

$pdf->Cell(0, 10, 'Ticket Invoice  ',0,1,'C');

$pdf->SetFont('Arial','',12);

$pdf->Ln(30);

$pdf->Cell(0, 10, 'This invoice contains the order number and barcode that gives you access to the flight',0,1,'L');

$pdf->Ln();


foreach ($_SESSION['Products'] as $item) {
    $pdf->Cell(0,10,'Date of purchase: ' . date("d/m/y"),0,1,'L');
    $pdf->Cell(0, 10, 'Order Number: ' .$item['ticketID'],0,1,'L');
    $pdf->Cell(0, 10, 'Price: ' .$item['Price'],0,1,'L');
    $pdf->Cell(0, 10, 'Airline: ' .$item['airline'],0,1,'L');
    $pdf->Cell(0, 10, 'From: ' .$item['flightFrom'],0,1,'L');
    $pdf->Cell(0, 10, 'To: ' .$item['flightTo'],0,1,'L');








// how to save PNG codes to server

    $tempDir = '../lib/qrcodes/';

    $codeContents = ' this is your QR code for the flight';

// we need to generate filename somehow,
// with md5 or with database ID used to obtains $codeContents...
    $fileName = '005_file_'.md5($item['ticketID']).'.png';

    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;

// generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);

    }

// displaying
    $pdf->Image($urlRelativeFilePath, null, null, 50, 50);
    $pdf->Cell(0,10,($item['flightFrom'] . ' ' .$item['flightTo'] . $codeContents),0,1,'L');
}



$pdf->output();






// Unset all of the session variables.
$_SESSION = array();
// Finally, destroy the session.
session_destroy();







?>