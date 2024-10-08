<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SewaKosNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sewa;
    public $kos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sewa, $kos)
    {
        $this->sewa = $sewa;
        $this->kos = $kos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sewa-kos-notification')
            ->with([
                'sewa' => $this->sewa,
                'kos' => $this->kos,
            ]);
    }


    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
