<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WeddingPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'is_popular',
        'city_id',
        'wedding_organizer_id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function weddingOrganizer(): BelongsTo
    {
        return $this->belongsTo(WeddingOrganizer::class, 'wedding_organizer_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(WeddingPhoto::class);
    }

    public function weddingBonusPackages(): HasMany
    {
        return $this->hasMany(WeddingBonusPackage::class, 'wedding_package_id');
    }

    public function weddingTestimonials(): HasMany
    {
        return $this->hasMany(WeddingTestimonial::class);
    }
}
