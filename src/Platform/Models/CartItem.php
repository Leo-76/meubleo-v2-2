<?php declare(strict_types=1);

namespace Meubleo\Platform\Models;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model {
    protected $table    = 'meubleo_cart_items';
    protected $fillable = ['user_id','session_id','product_id','quantity'];
    public function product() { return $this->belongsTo(Product::class); }
}

// ProductImage in separate file below
