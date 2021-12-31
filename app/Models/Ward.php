<?php

namespace App\Models;

use App\Builders\WardBuilder;
use App\Traits\OverridesBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ward extends Model
{
    use HasFactory, OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return WardBuilder::class;
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
        'district_id',
        'parent_code',
    ];

    // ======================================================================
    // Relationships
    // ======================================================================

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
