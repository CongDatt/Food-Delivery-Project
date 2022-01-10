<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Menu;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = ['merchant_id'];

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function menus() {
        return $this->belongsToMany(Menu::class);
    }
}
