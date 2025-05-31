<?php

declare(strict_types=1);

namespace App\Entity;

enum CategoryStatusEnum: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
}
