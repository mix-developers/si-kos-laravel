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
    public $id_user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sewa, $kos, $id_user)
    {
        $this->sewa = $sewa;
        $this->kos = $kos;
        $this->id_user = $id_user;
    }


    public function build()
    {

        $notification = EmailNotifikasi::where('id_user', $this->id_user)->where('jenis', 'remaining')->first();

        if (!$notification) {
            $notification = EmailNotifikasi::create([
                'id_user' => $this->id_user,
                'jenis' => 'remaining',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Proceed with building and sending the email
            return $this->view('emails.expired-notification')
                ->with([
                    'sewa' => $this->sewa,
                    'kos' => $this->kos,
                ]);
        }

        // If a matching record is found, simply return and do not send the email
        return;
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
