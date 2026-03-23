<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource; 

class UserResource extends JsonResource //Se usa Resource para no exponer campos que no queramos mostrar
//Asi controlamos exactamente que campos salen en la respuesta.
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname_1' => $this->surname_1,
            'surname_2' => $this->surname_2,
            'phone_number' => $this->phone_number,
            'city' => $this->city,
            'email' => $this->email,
            'created_at' => $this->created_at,
        ];
    }
}