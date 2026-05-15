<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeddingPackageResource extends JsonResource
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
            'price' => $this->price,
            'is_popular' => $this->is_popular,
            'thumbnail' => $this->thumbnail,
            'about' => $this->about,
            'city' => new CityResource($this->whenLoaded('city')),
            'wedding_organizer' => new WeddingOrganizerResource($this->whenLoaded('weddingOrganizer')),
            'photos' => WeddingPhotoResource::collection($this->whenLoaded('photos')),
            'wedding_bonus_packages' => WeddingBonusPackageResource::collection($this->whenLoaded('weddingBonusPackages')),
            'wedding_testimonials' => WeddingTestimonialResource::collection($this->whenLoaded('weddingTestimonials')),
        ];
    }
}
