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
       //'Username' => $this->username,
       //'Password' => $this->password,
       'Email' => $this->email,
       'Banca' => $this->banca,
       'Nome Intestatario' => $this->nomeintestatario,
       'Cognome Intestatario' => $this->cognomeintestatario,
       'Conto Carta' => $this->contocarta,
       'Mese scadenza' => $this->mesescadenza,
       'Anno scadenza' => $this->annoscadenza,
       'ABI' => $this->abi,
       'CAB' => $this->cab,
       'CIN' => $this->cin,
       'SEPA' => $this->sepa,
       'IBAN' => $this->iban,
       'Tipologia pagamento' => $this->tipologiapagamento,
   //    'id Tipologia cliente' => $this->idtipologiacliente,
       'Telefono' => $this->telefono,
       'Fax' => $this->fax,
       'P. IVA / CF' => $this->pivacf,
       'Indirizzo' => $this->indirizzo,
       'Localita' => $this->localita,
       'Comune' => $this->comune,
       'Provincia' => $this->provincia,
       'Stato' => $this->stato,
       'CAP' => $this->cap,
       'Creato' => $this->created_at->diffForHumans(),
	   'PEC' => $this->pec,
       'CID' => $this->cid,
       'PA' => $this->pa,
       'INTERNAL NOTES' => $this->internal_notes,
      // 'Aggiornato' => $this->updated_at->diffForHumans(),
      ];    
    }
}
