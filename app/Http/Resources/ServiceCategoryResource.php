<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
{
    public function toArray($request)
    {
      return [
       'id' => $this->id,
       'name' => $this->name,
       'services' => ServiceWithoutCategoryResource::collection($this->services),
       'created_at' => $this->created_at,
       'updated_at' => $this->updated_at,
      ];
    }
}
