<?php

namespace Tender;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

abstract class Currency extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'team_id',
        'name',
        'code',
        'rate',
        'precision',
        'symbol',
        'symbol_position',
        'decimal_mark',
        'thousands_separator',
        'enabled',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * Get the team that owns the currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Tender::teamModel(), 'team_id');
    }

    /**
     * Get all attached models of the given class to the currency.
     */
    public function entries(string $class): MorphToMany
    {
        return $this->morphedByMany(
            $class,
            'currensable',
            'currensables',
            'currency_id',
            'currensable_id',
            'id',
            'id'
        );
    }
}
