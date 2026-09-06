<?php

namespace Modules\Advertising\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'code',
        'status',
        'rate',
        'budget_total',
        'budget_daily',
        'geo_countries',
        'device_types',
        'user_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rate' => 'decimal:4',
            'budget_total' => 'decimal:2',
            'budget_daily' => 'decimal:2',
            'geo_countries' => 'array',
            'device_types' => 'array',
        ];
    }

    /**
     * The user acting as advertiser who owns this campaign.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The creatives that rotate during delivery.
     */
    public function creatives(): HasMany
    {
        return $this->hasMany(Creative::class);
    }
}
