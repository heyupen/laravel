<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
       'Email' => '',
       'Banca' => '',
       'Nome Intestatario' => '',
       'Cognome Intestatario' => '',
       'Conto carta' => '', 
       'Mese scadenza' => '',
       'Anno scadenza' => '',
       'ABI' => '',
       'CAB' => '',
       'CIN' => '',
       'SEPA' => '',
       'IBAN' => '',
       'Tipologia pagamento' => '',
       'Telefono' => '',
       'Fax' => '',
       'P. IVA / CF' => '',
       'Indirizzo' => '',
       'Localita' => '',
       'Comune' => '',
       'Provincia' => '',
       'Stato' => '',
       'CAP' => '',
       'PEC' => '',
       'CID' => '',
       'PA' => '',
       'INTERNAL NOTES' => ''
       ]]),
       'services' => ServiceResource::collection($this->services),
       'all_services' => ServiceCategoryResource::collection(\App\ServiceCategory::with('services')->get()),
       'status' => $this->status, 
       'link' => route('offer.view', [$this->id]),
       'status_change' => route('offer.status_update', [$this->id]),
       'created_at' => $this->created_at->diffForHumans(),
       'updated_at' => $this->updated_at->diffForHumans(),
      ];
    }
}
