<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmail extends Command
{
    protected $signature = 'send:email {--offerid=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email about offer.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
     $offer = \App\Offer::findOrFail($this->option('offerid'));
     if ($offer->status == 'Creata') {
      \Mail::to($offer->client->email)
       ->cc($offer->user->email)
       ->send(new \App\Mail\Proposal($offer));
      return;
     }
     if ($offer->status == 'Firmata') {
      \Mail::to($offer->client->email)
       ->cc($offer->user->email)
       ->send(new \App\Mail\ProposalSigned($offer));
      return;
     }

    }
}
