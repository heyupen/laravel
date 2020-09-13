<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceWithoutCategoryResource extends JsonResource
{
    public function toArray($request)
    {
      return [
       'id' => $this->id,
       'name' => $this->name,
       'price' => $this->price,
       'url' => $this->url,
       'pdf' => $this->category,
       'mandatory' => $this->mandatory,
       'category' => $this->category,
       'created_at' => $this->created_at,
       'updated_at' => $this->updated_at,
      ];    
    }
}
