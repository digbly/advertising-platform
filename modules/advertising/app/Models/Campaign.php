<?php

namespace Modules\Advertising\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Advertising\Database\Factories\CampaignFactory;

class Campaign extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): CampaignFactory
    // {
    //     // return CampaignFactory::new();
    // }
}
