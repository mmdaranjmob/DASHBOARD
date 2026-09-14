<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductFieldOption extends Model
{
    use HasFactory;

    protected $fillable = ['product_field_id', 'label', 'value', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function field(): BelongsTo
    {
        return $this->belongsTo(ProductField::class, 'product_field_id');
    }
}
