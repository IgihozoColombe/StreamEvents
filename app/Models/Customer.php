<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = ['name', 'email', 'provider'];

    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function subscriber(): HasMany
    {
        return $this->hasMany(Subscriber::class);
    }

    public function merch_sale(): HasMany
    {
        return $this->hasMany(MerchandiseSale::class);
    }
}
