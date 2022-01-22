<?php

namespace App\Models;

use App\Builders\MerchantBuilder;
use App\Traits\OverridesBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    use OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return MerchantBuilder::class;
    }
    protected $fillable = [
        'merchant_name', 'address', 'customer_name'
    ];
}
