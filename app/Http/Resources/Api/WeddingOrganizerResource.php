<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeddingOrganizerResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'phone' => $this->phone,
            'icon' => $this->icon,
            'weddingPackage_count' => $this->wedding_package_count,
            'weddingPackages' => WeddingPackageResource::collection($this->whenLoaded('weddingPackages')),
        ];
    }
}
