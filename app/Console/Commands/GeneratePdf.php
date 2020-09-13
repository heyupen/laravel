<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Symfony\Component\Process\Process;

class GeneratePdf extends Command
{
    protected $signature = 'generate:pdf {--offer=}';
    protected $description = 'Generate offer PDF';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
     $dt = Carbon::now();
     $dateFormatted = $dt->toFormattedDateString();
     $id = $this->option('offer');
     $offer = \App\Offer::find($id);
     $offerPdf = $offer->pdf;
     $services = $offer->services;
     $absolutePath = '/var/www/ordini/storage/app/';
     $pdf = \Storage::get('templates/pdf.tex');
     $includeServicePdf = ' \includegraphics[width=1.0\textwidth]{'.$absolutePath.'services/%}';
     $temp = str_random(20);
     if ($offer->client) {
      $pdf = str_replace('% CLIENT_NOME', $offer->client->nome, $pdf);
      $pdf = str_replace('% CLIENT_PIVACF', $offer->client->pivacf, $pdf);
      $pdf = str_replace('% CLIENT_INDIRIZZO', $offer->client->indirizzo, $pdf);
      $pdf = str_replace('% CLIENT_LOCALITA', $offer->client->localita, $pdf);
      $pdf = str_replace('% CLIENT_COMUNE', $offer->client->comune, $pdf);
      $pdf = str_replace('% CLIENT_PROVINCIA', $offer->client->provincia, $pdf);
      $pdf = str_replace('% CLIENT_STATO', $offer->client->stato, $pdf);
      $pdf = str_replace('% CLIENT_CAP', $offer->client->cap, $pdf);
     }
     /*foreach($services as $service) {
       $serviceCategoryName = $service->service_category->name;
       $serviceSummary = "\item $serviceCategoryName - ${service['name']} - ${service['price']} euro";
       $pdf = str_replace('% SUMMARY', '% SUMMARY'.PHP_EOL.$serviceSummary, $pdf);
      if (\Storage::exists("services/${service['id']}.pdf")) {
       $servicePdf = str_replace('%', $service->id, $includeServicePdf);
       $pdf = str_replace('% SERVICES', '% SERVICES'.PHP_EOL.$servicePdf, $pdf);
       $pdf = str_replace('% DATE', $dateFormatted, $pdf);
       $pdf = str_replace('% AGENT_NAME', $offer->user->agente . ' - ' .$offer->user->agenzia, $pdf);
      }
     }*/
        $i=1;
        foreach($services as $service) {
            $serviceCategoryName = $service->service_category->name;
            $serviceSummary = "\item $serviceCategoryName - ${service['name']} - ${service['price']} euro";
            $pdf = str_replace('% SUMMARY', '% SUMMARY'.PHP_EOL.$serviceSummary, $pdf);
            if (\Storage::exists("services/${service['id']}.pdf") && $i==1) {
                $servicePdf = str_replace('%', $service->id, $includeServicePdf);
                $pdf = str_replace('% SERVICES', '% SERVICES'.PHP_EOL.$servicePdf, $pdf);
                $pdf = str_replace('% DATE', $dateFormatted, $pdf);
                $pdf = str_replace('% AGENT_NAME', $offer->user->agente . ' - ' .$offer->user->agenzia, $pdf);
            }
            $i++;
        }
     if (\Storage::exists('signatures/'.$offer->id.'.png')) {
      $pdf = str_replace('% SIGNATURE', '\includegraphics[scale=0.5]{'.$absolutePath.'/signatures/'.$offer->id.'.png}', $pdf);
     }
     \Storage::put("temp/${temp}", $pdf);

     sleep(1);
       // $process = new Process("/usr/bin/pdflatex -output-directory /var/www/ordini/storage/app/public/offers/ /var/www/ordini/storage/app/temp/${temp}; mv /var/www/ordini/storage/app/public/offers/${temp}.pdf /var/www/ordini/storage/app/public/offers/${offerPdf}.pdf; rm /var/www/ordini/storage/app/public/offers/${temp}.aux; rm /var/www/ordini/storage/app/public/offers/${temp}.log");
        // $process = new Process("/usr/bin/pdflatex -output-directory /var/www/html/storage/app/public/offers/ /var/www/html/storage/app/temp/${temp}; mv /var/www/html/storage/app/public/offers/${temp}.pdf /var/www/html/storage/offers/${offerPdf}.pdf; rm /var/www/html/storage/app/public/offers/${temp}.aux; rm /var/www/html/storage/app/public/offers/${temp}.log");
        $process = new Process("/usr/bin/pdflatex -output-directory /var/www/ordini/storage/app/public/offers/ /var/www/ordini/storage/app/temp/${temp}; mv /var/www/ordini/storage/app/public/offers/${temp}.pdf /var/www/ordini/storage/offers/${offerPdf}.pdf; rm /var/www/ordini/storage/app/public/offers/${temp}.aux; rm /var/www/ordini/storage/app/public/offers/${temp}.log");

     try {
    $process->mustRun();

    echo $process->getOutput();
} catch (ProcessFailedException $exception) {
    echo $exception->getMessage();
}

    \Storage::delete("temp/${temp}");
    }
}
