<?php declare(strict_types=1);

namespace Meubleo\Platform\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
    protected $table    = 'meubleo_order_items';
    protected $fillable = ['order_id','product_id','product_name','quantity','unit_price','total_price'];
    protected $casts    = ['unit_price'=>'decimal:2','total_price'=>'decimal:2'];
    public function order()   { return $this->belongsTo(Order::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
