<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    protected $table = 'subcriber';
    protected $fillable =[
        'subscriber_name',
        'subscription_tier',
        'is_read',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
