<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetServices extends Command
{
    protected $signature = 'update:services';
    protected $description = 'Update available services';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
      $curl = curl_init();
      $header = array();
      $header[] = 'Authorization: '. env('FIBRAFORTE_API_KEY');
      curl_setopt($curl, CURLOPT_URL, env('FIBRAFORTE_API_ENDPOINT_SERVICES'));
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
      curl_setopt($curl, CURLOPT_POST, true);
      $response = curl_exec($curl);
      curl_close($curl);
      $response = json_decode($response, true);
      $response['response'] = json_decode($response['response']);
      foreach($response['response'] as $service) {
       $serviceCategory = \App\ServiceCategory::firstOrCreate(['name' => $service->nome]);
       $serviceNew = \App\Service::firstOrCreate([
        'name' => $service->voce,
        'price' => $service->prezzo,
        'url' => $service->url,
        'pdf' => $service->pdf,
        'category' => $service->categoria,
        'mandatory' => $service->obbligatoria,
        'service_category_id' => $serviceCategory->id,
       ]);
       $service_id = $serviceNew->id;
       if (!\Storage::exists("services/${service_id}.pdf") && $serviceNew->pdf) {
        $blob = file_get_contents($serviceNew->pdf);
        \Storage::put("services/${service_id}.pdf", $blob);
       }
      }
    }
}
