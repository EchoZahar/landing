<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meta_title'        => $this->meta_title,
            'meta_keywords'     => $this->meta_keywords,
            'meta_description'  => $this->meta_description,
        ];
    }
}
