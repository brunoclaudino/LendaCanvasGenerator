<?php

namespace App\Includes;

class MYPDF extends \TCPDF {
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
                if($header[$i] == 'Game Impact'){
                    $this->Cell($w[$i], 7, $header[$i], 0, 0, 'C', 1);
                }
                elseif ($header[$i] == 'Game Business') {
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
            if($header[$i] == 'Game Concept'){
                $cellcount[] = $this->MultiCell($w[$key],6,$column,0,'C',0,0, '', '', true, 0, false, true, $h[0], 'T', true);
                $i=1;
            }
            elseif($header[$i] == 'Game Impact' || $header[$i] == 'Game Business'){
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
                if($header[$i] == 'Game Concept'){
                    $i = 1;
                    $startX = $this->GetX();
                    $startY = $this->GetY();
                    $this->MultiCell($w[$key], $h[0],'','LRB','C', 0, 1, '', '', true, 0, false, true, $h[0], 'T', true);
                    $this->SetFont('helvetica', 'B', 12);
                    $this->MultiCell($w[$key], 7,'Game Player','LTR','C', 0, 1);
                    $this->SetFont('helvetica', '', 10);
                    $this->MultiCell($w[$key], $h[0], $player,'LRB','C', 0, 0, '', '', true, 0, false, true, $h[0], 'T', true);
                    $this->SetXY($startX + 50, $startY);
                }
                elseif($header[0] == 'Game Impact'){
                    $this->MultiCell($w[$key], $h[2],'', 0,'C', 0, 0, '', '', true, 0, false, true, $h[2], 'T', true);   
                }
                elseif ($header[0] == 'Game Business') {
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

?>
