<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'user_id',
        'first_name', 'last_name', 'email', 'phone',
        'payment_method', 'selected_bank', 'mobile_number', 'transaction_id',
        'subtotal', 'shipping_cost', 'tax_amount', 'grand_total',
        'status', 'order_notes',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingDetail()
    {
        return $this->hasOne(ShippingDetail::class);
    }
}