<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'stock'];

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class);
    }
}