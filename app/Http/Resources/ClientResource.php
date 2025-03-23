<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    // public static $wrap = ''; // Wrap the anwser.

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nome' => $this->name,
            'email' => new UserResource($this->user),
            'criado em' => $this->created_at->format('d\/m\/y')
        ];
    }
}
