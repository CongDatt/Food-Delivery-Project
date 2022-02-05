<?php

namespace App\Models;

use App\Builders\DishBuilder;
use App\Models\Menu;
use App\Traits\OverridesBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Dish extends Model
{
    use HasFactory;
    use OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return DishBuilder::class;
    }

    protected $fillable = ['merchant_id', 'dish_name', 'desc', 'price','image'];

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function menus() {
        return $this->belongsToMany(Menu::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
