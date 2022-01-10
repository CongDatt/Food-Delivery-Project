<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;
use App\Models\User;
use App\Models\Shipper;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'merchant_id', 'shipper_id'];

    public function dishes() {
        return $this->belongsToMany(Dish::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function shipper() {
        return $this->belongsTo(Shipper::class);
    }
}
