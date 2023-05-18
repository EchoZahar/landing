<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'icon'          => $this->icon,
            'email'         => $this->email,
            'name'          => $this->name,
            'short_text'    => $this->short_text,
            'full_text'     => $this->full_text,
            'navigation_id' => $this->navigation_id,
        ];
    }
}
