<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Includes\MYPDF;
use App\Mail\sendMail;
use Illuminate\Support\Facades\Mail;

class controllerFiles extends Controller
{
    function readJson(Request $request){
        $jsonString = file_get_contents($request->jsonFile);
        $data = json_decode($jsonString, true);
        return view('index', compact('data'));
    }

    function infos(Request $request){
        $data = $request->all();
        $impact = $data["impact"];
        $business = $data["business"];
        $concept = $this->get_variables("concept", 4, $data);
        $player = $this->get_variables("player", 5, $request);
        $play = $this->get_variables("play", 8, $request);
        $flow = $this->get_variables("flow", 4, $request);
        $core = $this->get_variables("core", 3, $request);
        $interaction = $this->get_variables("interaction", 5, $request);
        $pdf = $this->generate_pdf($impact, $business, $concept, $player, $play, $flow, $core, $interaction);
        $jsonFile = $this->generate_json($request);
        $this->send_email($data["email"], $pdf->Output('Unified_Game_Canvas.pdf', 'S'), $jsonFile);
        $pdf->Output('Unified_Game_Canvas.pdf', 'I');
    }


    function get_variables($varName, $numInfos, $data){
        $storage = "";
        $init = 0;
        for($i=1; $i<$numInfos+1; $i++){
            if(!empty($data[$varName.$i])){
                if($init==0){
                    $storage = $data[$varName.$i];
                    $init = 1;
                }
                else{
                    $storage = $storage."\n \n".$data[$varName.$i];
                }
            }
        }
        return $storage;
    }


    function generate_json($request){
        $dados = array(
            "impact"=>$request->impact,
            "business"=>$request->business,
            "concept1"=>$request->concept1, "concept2"=>$request->concept2, "concept3"=>$request->concept3, "concept4"=>$request->concept4,
            "player1"=>$request->player1, "player2"=>$request->player2, "player3"=>$request->player3, "player4"=>$request->player4, "player5"=>$request->player5,
            "play1"=>$request->play1, "play2"=>$request->play2, "play3"=>$request->play3, "play4"=>$request->play4, "play5"=>$request->play5, "play6"=>$request->play6, "play7"=>$request->play7, "play8"=>$request->play8,
            "flow1"=>$request->flow1, "flow2"=>$request->flow2, "flow3"=>$request->flow3, "flow4"=>$request->flow4,
            "core1"=>$request->core1, "core2"=>$request->core2, "core3"=>$request->core3,
            "interaction1"=>$request->interaction1, "interaction2"=>$request->interaction2, "interaction3"=>$request->interaction3, "interaction4"=>$request->interaction4, "interaction5"=>$request->interaction5,
            "email"=>$request->email);
        return $dados_jsonFile = json_encode($dados);
    }


    function send_email($email, $pdfFile, $jsonFile){
        if(!empty($email)) {
            Mail::to($email)->send(new sendMail($pdfFile, $jsonFile));
        }
    }

    function generate_pdf($impact, $business, $concept, $player, $play, $flow, $core, $interaction){
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

        // set font
        $pdf->SetFont('helvetica', '', 12);

        // add a page
        $pdf->AddPage('L', 'A4');

        $h = array(66.5, 140, 12);
        // print table 1
        $w = array(270);
        $header = array('Game Impact');
        $row = array($impact);
        $pdf->printTable($header, $row, $w, $h, '');

        // print table 2
        $style5 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $w = array(50, 5, 50, 5, 50, 5, 50, 5, 50, 5);
        $header = array('Game Concept', '', 'Game Play','', 'Game Flow','', 'Game Core','', 'Game Interaction');
        $space = array($pdf->Polygon(array(63.5,96,68.2,101,63.5,106), 'DF', array('all' => $style5), array(0, 0, 0), true),
            $pdf->Polygon(array(118.6,96.5,123.2,101,118.6,106.5), 'DF', array('all' => $style5), array(0, 0, 0), true),
            $pdf->Polygon(array(173.7,96.5,178.2,101,173.7,106.5), 'DF', array('all' => $style5), array(0, 0, 0), true),
            $pdf->Polygon(array(228.8,96.5,233.2,101,228.8,106.5), 'DF', array('all' => $style5), array(0, 0, 0), true),
            $pdf->Polygon(array(283.7,96.5,288.2,101.5,283.7,106.5), 'DF', array('all' => $style5), array(0, 0, 0), true));
        $row = array($concept, $space[0], $play, $space[1], $flow, $space[2], $core, $space[3], $interaction,$space[4]);
        $pdf->printTable($header, $row, $w, $h, $player);

        // print table 3
        $w = array(270);
        $header = array('Game Business');
        $row = array($business);
        $pdf->printTable($header, $row, $w, $h, '');
        $pdf->Line(5, 101.53, 13.5, 101.53, $style5);
        $pdf->Line(283.4, 101.53, 291.9, 101.53, $style5);

        // close and output PDF document
        return $pdf;
    }
}
