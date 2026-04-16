<?php

declare(strict_types=1);

namespace Meubleo\Platform\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table    = 'meubleo_products';
    protected $fillable = [
        'category_id','name','slug','description','details',
        'price','sale_price','stock','sku','material',
        'dimensions','color','is_featured','is_active',
    ];
    protected $casts = [
        'price'       => 'decimal:2',
        'sale_price'  => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn ($p) => $p->slug ??= Str::slug($p->name));
    }

    public function category()     { return $this->belongsTo(Category::class); }
    public function images()       { return $this->hasMany(ProductImage::class); }
    public function primaryImage() { return $this->hasOne(ProductImage::class)->where('is_primary', true); }
    public function orderItems()   { return $this->hasMany(OrderItem::class); }
    public function cartItems()    { return $this->hasMany(CartItem::class); }

    public function getCurrentPriceAttribute(): float { return (float)($this->sale_price ?? $this->price); }
    public function getIsOnSaleAttribute(): bool       { return $this->sale_price !== null && $this->sale_price < $this->price; }

    public function scopeActive($q)   { return $q->where('is_active', true); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }
    public function scopeInStock($q)  { return $q->where('stock', '>', 0); }
}
