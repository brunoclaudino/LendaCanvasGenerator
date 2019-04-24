<?php
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

?>