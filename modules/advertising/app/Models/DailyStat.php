<?php

namespace Modules\Advertising\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyStat extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'campaign_id',
        'website_id',
        'date',
        'impressions',
        'clicks',
        'spend',
        'revenue',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'impressions' => 'integer',
            'clicks' => 'integer',
            'spend' => 'decimal:2',
            'revenue' => 'decimal:2',
        ];
    }

    /**
     * The campaign this stat row aggregates.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * The website this stat row aggregates.
     */
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
