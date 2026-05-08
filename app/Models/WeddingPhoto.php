<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeddingPhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wedding_package_id',
        'photo',
    ];
}
