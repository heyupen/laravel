<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request)
    {
      return [
//       'id' => $this->id,
       'Nome' => $this->nome,
       'Telefono' => $this->telefono,
       'Fax' => $this->fax,
       //'Username' => $this->username,
       //'Password' => $this->password,
       'Email' => $this->email,
       'P. IVA / CF' => $this->pivacf,
       'Indirizzo' => $this->indirizzo,
       'Stato' => $this->stato,
       'Provincia' => $this->provincia,
       'Comune' => $this->comune,
       'Localita' => $this->localita,
       'CAP' => $this->cap,
       'Tipologia pagamento' => $this->tipologiapagamento,
       'Banca' => $this->banca,
       'Nome Intestatario' => $this->nomeintestatario,
       'Cognome Intestatario' => $this->cognomeintestatario,
       'IBAN' => $this->iban,
       'Conto Carta' => $this->contocarta,
       'Mese scadenza' => $this->mesescadenza,
       'Anno scadenza' => $this->annoscadenza,
       'ABI' => $this->abi,
       'CAB' => $this->cab,
       'CIN' => $this->cin,
       'SEPA' => $this->sepa,
       'Creato' => $this->created_at->diffForHumans(),
       'PEC' => $this->pec,
       'CID' => $this->cid,
       'PA' => $this->pa,
       'Internal notes' => $this->internalnotes,      
   //    'id Tipologia cliente' => $this->idtipologiacliente, 
      // 'Aggiornato' => $this->updated_at->diffForHumans(),
      ];    
    }
}
