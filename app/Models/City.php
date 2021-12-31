<?php

namespace App\Models;

use App\Builders\CityBuilder;
use App\Traits\OverridesBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class City extends Model
{
    use HasFactory, OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return CityBuilder::class;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code',
        'division_type',
    ];

    // ======================================================================
    // Relationships
    // ======================================================================

    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'city_id', 'id');
    }

    public function wards(): HasManyThrough
    {
        return $this->hasManyThrough(Ward::class, District::class);
    }
}
