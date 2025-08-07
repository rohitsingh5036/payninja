<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock_quantity'];

    public function decreaseStock($quantity)
    {
        if ($this->stock_quantity < $quantity) {
            throw new \Exception("Insufficient stock");
        }
        $this->decrement('stock_quantity', $quantity);
    }
}