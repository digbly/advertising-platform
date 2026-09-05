<?php

namespace Modules\Contact\Enums;

enum ContactStatusEnum: string
{
    case Pending = 'pending';
    case Read = 'read';
    case Resolved = 'resolved';
}
