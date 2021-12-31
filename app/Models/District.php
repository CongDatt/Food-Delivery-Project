<?php

namespace App\Models;

use App\Builders\DistrictBuilder;
use App\Traits\OverridesBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory, OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return DistrictBuilder::class;
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
        'city_id',
        'parent_code',
    ];

    // ======================================================================
    // Relationships
    // ======================================================================

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class, 'district_id', 'id');
    }
}
