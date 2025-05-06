<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'email',
    ];
    protected $table = 'product_notifications';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
