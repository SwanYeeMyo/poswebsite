<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'view_count',
    ];
    public function category()
    {
        return $this->BelongsTo(Category::class);
    }
    public function cart(){
        return $this->BelongsTo(Cart::class,'product_id');
    }


}
