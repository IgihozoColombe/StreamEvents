<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $table = 'donations';
    protected $fillable =[
        'amount',
        'currency',
        'donation_message',
         'is_read',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
