<?php

// Include the main TCPDF library (search for installation path).
require_once('TCPDF/tcpdf.php');

$impact = $_POST["impact"];
$concept = $_POST["concept"];
$player = $_POST["player"];
$flow = $_POST["flow"];
$play = $_POST["play"];
$core = $_POST["core"];
$interaction = $_POST["interaction"];
$bussiness = $_POST["bussiness"];
$caption = $_POST["caption"];


class MYPDF extends TCPDF {
    public function printTable($header, $row, $w) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0,0,0);
        $this->SetDrawColor(128, 128, 128);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = 0;
        $cellcount = array();

        //write text first
        $startX = $this->GetX();
        $startY = $this->GetY();
        foreach ($row as $key => $column):
            $cellcount[] = $this->MultiCell($w[$key],6,$column,0,'C',$fill,0);
        endforeach;
     
        $this->SetXY($startX,$startY);
         
        $maxnocells = max($cellcount);
         
        foreach ($row as $key => $column):
            $this->MultiCell($w[$key],5.4*$maxnocells,'','LRB','C',$fill,0);
        endforeach;
        
        $this->Ln();     
    }

    public function caption($header, $w){
        $this->Ln();
        // Colors, line width and bold font
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0,0,0);
        $this->SetDrawColor(128, 128, 128);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 0, $header[$i], 0, 0, 'C', 1);
        }
        $this->Ln();
    }

    public function Header() {
        // Title
        if($this->getPage()!=1){
            $this->SetDrawColor(128, 128, 128);
            $this->SetLineWidth(0.3);
            $this->Ln();
            $this->Cell(270, 0, '', 'B', false, 'C', 0, '', 0, false, 'M', 'M');
        }
    }

    // Page footer
    public function Footer() {
        $this->SetDrawColor(128, 128, 128);
        $this->SetLineWidth(0.3);
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(270, 0, '', 'T', false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln();
        $this->Cell(270, 0, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('LEnDA - Laboratório de Entretenimento Digital Aplicado');
$pdf->SetTitle('Unified Game Canvas');
$pdf->SetSubject('Unified Game Canvas');
$pdf->SetKeywords('Unified, Game, PDF, Canvas');

// set footer fonts
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 8, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 15);
//$pdf->SetPrintHeader(false);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage('L', 'A4');

// print table 1
$w = array(270);
$header = array('GAME IMPACT');
$row = array($impact);
$pdf->printTable($header, $row, $w);

// print table 2
$w = array(45, 45, 45, 45, 45, 45);
$header = array('GAME CONCEPT', 'GAME PLAYER', 'GAME FLOW', 'GAME PLAY', 'GAME CORE', 'GAME INTERACTION');
$row = array($concept,$player,$flow,$play,$core,$interaction);
$pdf->printTable($header, $row, $w);

// print table 3
$numPages = $pdf->getNumPages();
$pdf->setPage($numPages);
if($pdf->getPage()>1){
    $pdf->SetY($pdf->GetY()-19.3);
}
$w = array(270);
$header = array('GAME BUSSINESS');
$row = array($bussiness);
$pdf->printTable($header, $row, $w);

$header = array($caption);
$w = array(270);
$pdf->caption($header, $w);

// close and output PDF document
$pdf->Output('Unified_Game_Canvas.pdf', 'I');

?>