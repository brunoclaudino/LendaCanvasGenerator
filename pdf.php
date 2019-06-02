<?php
<<<<<<< HEAD

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

class MYPDF extends TCPDF {

    public function printTable($header, $row, $w, $h, $player) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 255, 255);
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(0,0,0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            if($w[$i]==5){
                $this->Cell($w[$i], 7, $header[$i], 'LR', 0, 'C', 1);
            }
            else{
                if($header[$i] == 'GAME IMPACT'){
                    $this->Cell($w[$i], 7, $header[$i], 0, 0, 'C', 1);
                }
                elseif ($header[$i] == 'GAME BUSSINESS') {
                    $this->SetY($this->GetY()+5);
                    $this->Cell($w[$i], 7, $header[$i], 0, 0, 'C', 1);
                }
                else{
                    $this->Cell($w[$i], 7, $header[$i], 'LRT', 0, 'C', 1);
                }
            }
        }
        $this->Ln();
        $this->SetLineWidth(0.3);
        $this->SetFont('helvetica', '', 10);
        $cellcount = array();
        $i=0;
        $startX = $this->GetX();
        $startY = $this->GetY();
        foreach ($row as $key => $column):
            if($header[$i] == 'GAME CONCEPT'){
                $cellcount[] = $this->MultiCell($w[$key],6,$column,0,'C',0,0, '', '', true, 0, false, true, $h[0], 'T', true);
                $i=1;
            }
            elseif($header[$i] == 'GAME IMPACT' || $header[$i] == 'GAME BUSSINESS'){
                $cellcount[] = $this->MultiCell($w[$key],6,$column,0,'C',0,0, '', '', true, 0, false, true, $h[2], 'T', true);
            }
            else{
                $cellcount[] = $this->MultiCell($w[$key],6,$column,0,'C',0,0, '', '', true, 0, false, true, $h[1], 'T', true);
            }
        endforeach;
        $this->SetXY($startX,$startY);

        $i = 0; 
        foreach ($row as $key => $column):
            if($w[$key]==5){
                $this->MultiCell($w[$key], $h[1], '', 0, 'C', 0, 0);
            }
            else{
                if($header[$i] == 'GAME CONCEPT'){
                    $i = 1;
                    $startX = $this->GetX();
                    $startY = $this->GetY();
                    $this->MultiCell($w[$key], $h[0],'','LRB','C', 0, 1, '', '', true, 0, false, true, $h[0], 'T', true);
                    $this->SetFont('helvetica', 'B', 12);
                    $this->MultiCell($w[$key], 7,'GAME PLAYER','LTR','C', 0, 1);
                    $this->SetFont('helvetica', '', 10);
                    $this->MultiCell($w[$key], $h[0], $player,'LRB','C', 0, 0, '', '', true, 0, false, true, $h[0], 'T', true);
                    $this->SetXY($startX + 50, $startY);
                }
                elseif($header[0] == 'GAME IMPACT'){
                    $this->MultiCell($w[$key], $h[2],'', 0,'C', 0, 0, '', '', true, 0, false, true, $h[2], 'T', true);   
                }
                elseif ($header[0] == 'GAME BUSSINESS') {
                    $this->MultiCell($w[$key], $h[2],'', 0, 'C', 0, 0, '', '', true, 0, false, true, $h[2], 'T', true);
                }
                else{
                    $this->MultiCell($w[$key], $h[1], '', 'LRB', 'C', 0, 0, '', '', true, 0, false, true, $h[1], 'T', true);
                }
            }
        endforeach;
        $this->Ln();
    }

    public function Header() {
       $this->SetLineStyle( array( 'width' => 0.40, 'color' => array(0, 0, 0)));
       $this->Line(5, 5, $this->getPageWidth()-5, 5); 
       $this->Line($this->getPageWidth()-5, 5, $this->getPageWidth()-5,  $this->getPageHeight()-5);
       $this->Line(5, $this->getPageHeight()-5, $this->getPageWidth()-5, $this->getPageHeight()-5);
       $this->Line(5, 5, 5, $this->getPageHeight()-5);
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

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(13.5, 9, 13.5);
$pdf->SetFooterMargin(0);

// set auto page breaks
$pdf->SetAutoPageBreak(FALSE, 10);
$pdf->SetPrintFooter(false);
//$pdf->SetPrintHeader(false);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage('L', 'A4');

$h = array(66.5, 140, 12);

// print table 1
$w = array(270);
$header = array('GAME IMPACT');
$row = array($impact);
$pdf->printTable($header, $row, $w, $h, '');

// print table 2
$style5 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$w = array(50, 5, 50, 5, 50, 5, 50, 5, 50, 5);
$header = array('GAME CONCEPT', '', 'GAME PLAY','', 'GAME FLOW','', 'GAME CORE','', 'GAME INTERACTION');
$space = array($pdf->Polygon(array(63.5,96,68.2,101,63.5,106), 'DF', array('all' => $style5), array(0, 0, 0), true),
$pdf->Polygon(array(118.6,96.5,123.2,101,118.6,106.5), 'DF', array('all' => $style5), array(0, 0, 0), true),
$pdf->Polygon(array(173.7,96.5,178.2,101,173.7,106.5), 'DF', array('all' => $style5), array(0, 0, 0), true),
$pdf->Polygon(array(228.8,96.5,233.2,101,228.8,106.5), 'DF', array('all' => $style5), array(0, 0, 0), true),
$pdf->Polygon(array(283.7,96.5,288.2,101.5,283.7,106.5), 'DF', array('all' => $style5), array(0, 0, 0), true));
$row = array($concept, $space[0], $play, $space[1], $flow, $space[2], $core, $space[3], $interaction, $space[4]);
$pdf->printTable($header, $row, $w, $h, $player);

// print table 3
$numPages = $pdf->getNumPages();
$pdf->setPage($numPages);
if($pdf->getPage()>1){
    $pdf->SetY($pdf->GetY()-19.3);
}
$w = array(270);
$header = array('GAME BUSSINESS');
$row = array($bussiness);
$pdf->printTable($header, $row, $w, $h, '');
$pdf->Line(5, 101.53, 13.5, 101.53, $style5);
$pdf->Line(283.4, 101.53, 291.9, 101.53, $style5);

// close and output PDF document
$pdf->Output('Unified_Game_Canvas.pdf', 'I');
=======
    use Dompdf\Dompdf;
    // include autoloader
    require_once 'dompdf/autoload.inc.php';

    $impact = $_POST["impact"];
    $concept = $_POST["concept"];
    $player = $_POST["player"];
    $flow = $_POST["flow"];
    $play = $_POST["play"];
    $core = $_POST["core"];
    $interaction = $_POST["interaction"];
    $bussiness = $_POST["bussiness"];
    $caption = $_POST["caption"];

    $pdf = new DOMPDF();

    //a função load_html carrega o html que será impresso no pdf
    $pdf -> load_html('
        <head><link rel="stylesheet" type="text/css" href="estilo.css"/></head>
        <body>
        <div>
            <table id="canvas">
                <tr><td colspan="6"><p>Game Impact</p></td></tr>
                <tr><td colspan="6" style="text-align:center;">'.$impact.'</td></tr>
                <tr><td id="info"> <p>GAME CONCEPT</br><textarea name="concept" cols="25" rows="20">'.$concept.'</textarea></p></td><td id="info"><p>GAME PLAYER</br><textarea name="player" cols="25" rows="20">'.$player.'</textarea></p></td><td id="info"><p>GAME FLOW</br><textarea name="flow" cols="25" rows="20">'.$flow.'</textarea></p></td><td id="info"><p>GAME PLAY</br><textarea name="play" cols="25" rows="20">'.$play.'</textarea></p></td><td id="info"><p>GAME CORE</br><textarea name="core" cols="25" rows="20">'.$core.'</textarea></p></td><td id="info"><p>GAME INTERACTION</br><textarea name="interaction" cols="25" rows="20">'.$interaction.'</textarea></p></td></tr>
                <tr><td colspan="6"><p>GAME BUSSINESS</p></td></tr>
                <tr><td colspan="6" style="text-align:center;">'.$bussiness.'</td></tr>
            </table>
        </div>
        <div>
            <p style="text-align:center;">'.$caption.'</p>
        </div>
        </body>
    ');

    //renderiza o pdf carregado
    $pdf->render();

    //exibir a página
    $pdf->stream("Unified_Game_Canvas.pdf", array("Attachment" => false));
>>>>>>> parent of 1322382... geração de pdf funcionando

?>