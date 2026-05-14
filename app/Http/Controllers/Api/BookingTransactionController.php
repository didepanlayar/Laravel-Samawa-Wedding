<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingTransactionRequest;
use App\Http\Resources\Api\BookingTransactionResource;
use App\Http\Resources\Api\ViewBookingDetailsResource;
use App\Models\BookingTransaction;
use App\Models\WeddingPackage;
use Illuminate\Http\Request;

class BookingTransactionController extends Controller
{
    public function store(StoreBookingTransactionRequest $request)
    {
        $validatedData = $request->validated();

        $weddingPackage = WeddingPackage::find($validatedData['wedding_package_id']);

        if ($request->hasFile('proof')) {
            $filePath = $request->file('proof')->store('transactions', 'public');
            $validatedData['proof'] = $filePath;
        }

        $validatedData['is_paid'] = false;
        $validatedData['booking_trx_id'] = BookingTransaction::generateUniqueTrxId();

        $bookingTransaction = BookingTransaction::create($validatedData);
        $bookingTransaction->load('weddingPackage');

        return new BookingTransactionResource($bookingTransaction);
    }

    public function booking_details(Request $request)
    {
        $request->validate([
            'booking_trx_id' => 'required|string',
            'phone' => 'required|string',
        ]);

        $booking = BookingTransaction::where('phone', $request->phone)->where('booking_trx_id', $request->booking_trx_id)
            ->with([
                'weddingPackage',
                'weddingPackage.city' => function ($query) {
                    $query->withCount('weddingPackages');
                },
                'weddingPackage.weddingBonusPackages.bonusPackage',
                'weddingPackage.weddingOrganizer' => function ($query) {
                    $query->withCount('weddingPackages');
                }
            ])->first();
        
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return new ViewBookingDetailsResource($booking);
    }
}
