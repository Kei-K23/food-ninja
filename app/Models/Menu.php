<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
        'restaurant_id',
        'image_url'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shoppingCarts(): HasMany
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['term'] ?? false) {
            $query->where('name', 'like', '%' . $filters['term'] . '%');
        }
        $query->orderBy('created_at', 'desc');
    }
}
