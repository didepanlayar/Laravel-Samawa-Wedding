<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_trx_id',
        'name',
        'phone',
        'email',
        'proof',
        'total_amount',
        'price',
        'total_tax_amount',
        'is_paid',
        'started_at',
        'wedding_package_id',
    ];

    public function weddingPackage(): BelongsTo
    {
        return $this->belongsTo(WeddingPackage::class, 'wedding_package_id');
    }

    public static function generateUniqueTrxId()
    {
        $prefix = 'SMW-';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (Self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }
}
