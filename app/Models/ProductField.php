<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductField extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'name', 'key', 'type', 'description', 'validation_rules',
        'is_required', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'validation_rules' => 'array',
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductFieldOption::class)->orderBy('sort_order');
    }
}
