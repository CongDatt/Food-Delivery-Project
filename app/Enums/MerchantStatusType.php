<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class MerchantStatusType extends Enum
{
    public const PENDING = 0;
    public const ACTIVE = 1;
    public const SUSPENDED = 2;
}
