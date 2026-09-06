<?php

namespace Modules\Advertising\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Advertising\Database\Factories\CampaignCategoryFactory;

class CampaignCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): CampaignCategoryFactory
    // {
    //     // return CampaignCategoryFactory::new();
    // }
}
