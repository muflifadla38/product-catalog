<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function scopeFilter($query, $request)
    {
        return $query->when($request->search, function ($q, $search) {
            return $q->where('name', 'ILIKE', "%$search%");
        })
            ->when($request->product_category_id, function ($q, $category) {
                return $q->where('product_category_id', $category);
            });
    }
}
