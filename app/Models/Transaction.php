<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reference',
        'email',
        'location',
        'amount',
        'currency',
        'status',
        'car_type',
        'seat_number',
        'ticket_id',
        'payment_method',
    ];

    public static function generateTicketId()
    {
        // Get the last record from the table
        $lastRecord = self::latest('id')->first();

        // Check if a ticket_id exists, and extract the last number if it does
        if ($lastRecord && $lastRecord->ticket_id) {
            $lastNumber = (int) substr($lastRecord->ticket_id, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // Start from 001 if there's no previous ticket_id
            $newNumber = '001';
        }

        // Generate the new ticket ID
        return "NJ-MVE-31A-{$newNumber}";
    }


}
