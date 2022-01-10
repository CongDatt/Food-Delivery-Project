<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Shipper extends Model
{
    use HasFactory;


    public function order() {
        return $this->hasMany(Order::class);
    }
}
