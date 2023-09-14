<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchSale extends Model
{
    use HasFactory;
    protected $table = 'merch_sales';
    protected $fillable =[
        'item_name',
        'amount',
        'price',
        'is_read',
    ];  
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
