<?php

namespace Modules\Contact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Contact\Database\Factories\ContactFactory;
use Modules\Contact\Enums\ContactStatusEnum;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
        'user_agent',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => ContactStatusEnum::class,
    ];

    protected static function newFactory(): ContactFactory
    {
        return ContactFactory::new();
    }
}
