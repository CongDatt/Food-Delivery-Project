<?php

namespace App\Models;

use App\Traits\OverridesBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Builders\ShipperBuilder;
use Illuminate\Notifications\Notifiable;

class Shipper extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return ShipperBuilder::class;
    }
    protected $fillable = [
        'customer_name', 'shipper_name', 'email', 'password',
    ];


    public function order() {
        return $this->hasMany(Order::class);
    }
}
