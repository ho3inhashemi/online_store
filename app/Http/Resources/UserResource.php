<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'name' => $this->name ,
            'family_name' => $this->family_name ,
            'email' => $this->email ,
            'mobile' => $this->mobile ,
            'status' => $this->status ? 'active' : 'in_active' ,
            'full_name' => $this->full_name
        ];
    }
}
