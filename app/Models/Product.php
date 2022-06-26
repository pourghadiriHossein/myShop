<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id',
        'product_tag_id',
        'label',
        'description',
        'price',
        'status'
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function productTag()
    {
        return $this->belongsTo(ProductTag::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderListItems()
    {
        return $this->hasMany(OrderListItem::class);
    }
}
