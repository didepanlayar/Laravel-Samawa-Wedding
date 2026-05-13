<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewBookingDetailsResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'proof' => $this->proof,
            'booking_trx_id' => $this->booking_trx_id,
            'is_paid' => $this->is_paid,
            'total_amount' => $this->total_amount,
            'started_at' => $this->started_at,
            'weddingPackage' => new WeddingPackageResource($this->whenLoaded('weddingPackage')),
        ];
    }
}
