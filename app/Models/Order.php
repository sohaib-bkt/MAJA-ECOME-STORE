<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'email',
        'first_name',
        'last_name',
        'address',
        'city',
        'phone',
        'payment_method',
        'stripe_session_id',
        'paid'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
