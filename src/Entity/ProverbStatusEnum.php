<?php

declare(strict_types=1);

namespace App\Entity;

enum ProverbStatusEnum: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
    case PENDING_CATEGORIZATION = 'pending_category';
}
