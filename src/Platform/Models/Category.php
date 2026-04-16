<?php declare(strict_types=1);

namespace Meubleo\Platform\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table    = 'meubleo_categories';
    protected $fillable = ['name','slug','description','image','is_active'];
    protected $casts    = ['is_active' => 'boolean'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn ($c) => $c->slug ??= Str::slug($c->name));
    }

    public function products() { return $this->hasMany(Product::class); }
}
