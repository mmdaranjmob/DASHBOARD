<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'image', 'price', 'old_price',
        'currency', 'delivery_type', 'delivery_minutes', 'has_inventory', 'inventory',
        'is_active', 'is_featured', 'sort_order', 'delivery_config',
    ];

    protected $casts = [
        'price' => 'integer',
        'old_price' => 'integer',
        'delivery_minutes' => 'integer',
        'inventory' => 'integer',
        'has_inventory' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'delivery_config' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(ProductField::class)->orderBy('sort_order');
    }
}
