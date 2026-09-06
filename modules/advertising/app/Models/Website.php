<?php

namespace Modules\Advertising\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'url',
        'name',
        'status',
    ];

    /**
     * The user acting as publisher who owns this website.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
