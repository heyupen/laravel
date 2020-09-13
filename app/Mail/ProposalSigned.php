<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProposalSigned extends Mailable
{
    use Queueable, SerializesModels;

    public $offer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Offer $offer)
    {
     $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
     return $this->view('emails.proposalSigned')
      ->attach('/var/www/ordini/storage/app/public/offers/'.$this->offer->pdf.'.pdf', [
       'as' => 'Contratto.pdf',
       'mime' => 'application/pdf',
      ])->subject('Contratto firmato');
    }
}
