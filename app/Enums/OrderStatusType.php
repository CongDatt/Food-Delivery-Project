<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class OrderStatusType extends Enum
{
    public const FINDING = 0;
    public const PREPARING = 1;
    public const DELIVERING = 2;
    public const DELIVERED = 3;
    public const RECEIVED = 4;
}
