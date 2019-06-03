<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $jsonFile;
    public $pdfFile;

    /**
     * Create a new message instance.
     *
     * @param $jsonFile
     */
    public function __construct($pdfFile, $jsonFile)
    {
        $this->pdfFile = base64_encode($pdfFile);
        $this->jsonFile = base64_encode($jsonFile);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        dd($this->jsonFile);
        return $this->from("unified.game.canvas@gmail.com")
            ->subject("You Unified Game Canvas Files")
            ->view('emailScope')
            ->attachData(base64_decode($this->jsonFile), 'Unified_Game_Canvas.jason', [
            'mime' => 'application/jason',])
            ->attachData(base64_decode($this->pdfFile), 'Unified_Game_Canvas.pdf', [
                'mime' => 'application/pdf',]);
    }
}
