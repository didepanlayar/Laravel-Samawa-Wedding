<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeddingBonusPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wedding_package_id',
        'bonus_package_id',
    ];

    public function weddingPackage(): BelongsTo
    {
        return $this->belongsTo(WeddingPackage::class, 'wedding_package_id');
    }

    public function bonusPackage(): BelongsTo
    {
        return $this->belongsTo(BonusPackage::class, 'bonus_package_id');
    }
}
