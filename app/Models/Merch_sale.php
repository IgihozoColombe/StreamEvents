<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merch_sale extends Model
{
    use HasFactory;
    protected $table = 'merch_sales';
    protected $fillable =[
        'item_name',
        'amount',
        'price',
    ];  
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
