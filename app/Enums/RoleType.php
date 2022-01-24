<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleType extends Enum
{
    public const ADMIN = 'admin';

    public const USER = 'user';

    public const SHIPPER = 'shipper';

    public const MERCHANT = 'merchant';
}
