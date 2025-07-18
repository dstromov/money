<?php

namespace App\Http\Resources;

use App\Http\Resources\DenominationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CurrencyResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'label' => $this->label,
            'country' => $this->country,
            'rate' => $this->rate,
            'denominations' => DenominationResource::collection($this->denominations),
            'full_summ' => $this->full_summ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
