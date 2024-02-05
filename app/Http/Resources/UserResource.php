<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            // Add any other user properties you want to include in the response
        ];
    }
}
