<?php declare(strict_types=1);

namespace Meubleo\Platform\Models;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {
    protected $table    = 'meubleo_product_images';
    protected $fillable = ['product_id','path','is_primary'];
    protected $casts    = ['is_primary' => 'boolean'];
    public function product() { return $this->belongsTo(Product::class); }
}
