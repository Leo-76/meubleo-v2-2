<?php declare(strict_types=1);

namespace Meubleo\Platform\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $table    = 'meubleo_orders';
    protected $fillable = [
        'user_id','order_number','status','subtotal','shipping','tax','total',
        'payment_method','payment_id','shipping_name','shipping_address',
        'shipping_city','shipping_postal_code','shipping_country','shipping_phone','notes',
    ];
    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'tax'      => 'decimal:2',
        'total'    => 'decimal:2',
    ];

    public const STATUS_LABELS = [
        'pending'    => ['label' => 'En attente',    'badge' => 'warning'],
        'paid'       => ['label' => 'Payée',          'badge' => 'info'],
        'processing' => ['label' => 'En traitement',  'badge' => 'primary'],
        'shipped'    => ['label' => 'Expédiée',       'badge' => 'secondary'],
        'delivered'  => ['label' => 'Livrée',         'badge' => 'success'],
        'cancelled'  => ['label' => 'Annulée',        'badge' => 'danger'],
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn ($o) => $o->order_number ??= 'CMD-' . strtoupper(Str::random(8)));
    }

    public function user()  { return $this->belongsTo(config('meubleo.user_model', \App\Models\User::class)); }
    public function items() { return $this->hasMany(OrderItem::class); }

    public function getStatusLabelAttribute(): string { return self::STATUS_LABELS[$this->status]['label'] ?? $this->status; }
    public function getStatusBadgeAttribute(): string { return self::STATUS_LABELS[$this->status]['badge'] ?? 'secondary'; }
}
