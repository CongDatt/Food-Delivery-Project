<?php

namespace App\Models;

use App\Traits\OverridesBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Builders\ShipperBuilder;

class Shipper extends Model
{
    use HasFactory;
    use OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return ShipperBuilder::class;
    }
    protected $fillable = [
        'customer_name', 'shipper_name'
    ];


    public function order() {
        return $this->hasMany(Order::class);
    }
}
