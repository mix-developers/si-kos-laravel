<?php

namespace App\Mail;

use App\Models\EmailNotifikasi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpiredNotification extends Mailable
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


    public function build()
    {
        $notification = EmailNotifikasi::where('jenis', 'remaining')->first();

        // If no matching notification is found, return early and don't send the email
        if (!$notification) {
            return;
        }
        return $this->view('emails.expired-notification')
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
