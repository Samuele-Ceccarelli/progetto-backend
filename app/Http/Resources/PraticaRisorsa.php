<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PraticaRisorsa extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_pratica' => $this->id_pratica,
            'id_cliente' => $this->id_cliente,
            'importo' => $this->importo,
            'descrizione' => $this->descrizione,
            'data_apertura' => $this->data_apertura,
            'stato' => $this->stato,
        ];
    }
}
