<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\WeddingOrganizerResource;
use App\Models\WeddingOrganizer;
use Illuminate\Http\Request;

class WeddingOrganizerController extends Controller
{
    public function index()
    {
        $weddingOrganizers = WeddingOrganizer::withCount('weddingPackages')->get();

        return WeddingOrganizerResource::collection($weddingOrganizers);
    }

    public function show(WeddingOrganizer $weddingOrganizer)
    {
        $weddingOrganizer->load([
            'weddingPackages.photo',
            'weddingPackages.weddingOrganizer' => function ($query) {
                $query->withCount('weddingPackages');
            }
        ])->loadCount('weddingPackages');

        return new WeddingOrganizerResource($weddingOrganizer);
    }
}
