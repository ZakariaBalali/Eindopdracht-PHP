<?php

require_once '../lib/fpdf.php';

 class PDF extends FPDF
 {
   function Header()
   {
       //logo
       $this->Image('/../View/images/logopdf.jpg',10,6,30);
       // give it a font
       $this->SetFont('Arial','B',15);
       // move to the right
       $this->Cell(80);
       // title
       $this->Cell(55,10,'Haarlem-Festival Ticket',1,0,'C');
       // line break
       $this->Ln(20);
   }
   function Footer()
   {
       //botton 1.5 cm
       $this->SetY(-15);
       $this->SetFont('Arial','I',8);
       //page number
       $this->Cell(0,10,'Page' .$this->PageNo().'/{nb}',0,0,'C');
   }
   


 }









?>