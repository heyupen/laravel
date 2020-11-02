<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource1 extends JsonResource
{
    public function toArray($request)
    {
      return [
       'id' => $this->id,
        'pdf' => \Storage::url('offers/'.$this->pdf.'.pdf'),
       'service_ids' => $this->service_ids,
       'name' => $this->name,
       'username' => $this->user->username,
       'agenzia' => $this->user->agenzia,
       $this->mergeWhen($this->client, [
        'client' => new ClientResource($this->client), 
       ]),
       $this->mergeWhen(!$this->client, [
        'client' => [ 
       'Nome' => '',
       'Telefono' => '',
       'Fax' => '',
       'Email' => '',
       'P. IVA / CF' => '',
       'Indirizzo' => '',
       'Stato' => '',
       'Provincia' => '',
       'Comune' => '',
       'Localita' => '',
       'CAP' => '',
       'Tipologia pagamento' => '',
       'Banca' => '',
       'Nome Intestatario' => '',
       'Cognome Intestatario' => '',
       'IBAN' => '',
       'Conto Carta' => '',
       'Mese scadenza' => '',
       'Anno scadenza' => '',
       'ABI' => '',
       'CAB' => '',
       'CIN' => '',
       'SEPA' =>'',       
       'PEC' => '',
       'CID' => '',
       'PA' => '',
       'Internal notes' => '',

       ]]),
       'services' => ServiceResource::collection($this->services),
       'total_price' => $this->gettotalprice($this->services),
       'all_services' => ServiceCategoryResource::collection(\App\ServiceCategory::with('services')->get()),
       'status' => $this->status, 
       'test' => $this->test,
       'link' => route('offer.view', [$this->id]),
       'status_change' => route('offer.status_update', [$this->id]),
       'created_at' => $this->created_at->diffForHumans(),
       'updated_at' => $this->updated_at->diffForHumans(),
      ];
    }

    public function gettotalprice($services) {
      $price = 0;
      for($i = 0; $i < sizeof($services); $i++) {
        $price = $price + $services[$i]['price'];
      }
      return sprintf('%.2f', $price);
    }
}
