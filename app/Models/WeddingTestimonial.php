<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeddingTestimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'wedding_package_id',
        'message',
        'occupation',
    ];

    public function weddingPackage(): BelongsTo
    {
        return $this->belongsTo(WeddingPackage::class, 'wedding_package_id');
    }
}
