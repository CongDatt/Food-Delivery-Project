<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PermissionType extends Enum
{
    public const VIEW_ROLE = 'view-role';

    public const CREATE_ROLE = 'create-role';

    public const UPDATE_ROLE = 'update-role';

    public const DELETE_ROLE = 'delete-role';

    public const VIEW_USER = 'view-user';

    public const CREATE_USER = 'create-user';

    public const UPDATE_USER = 'update-user';

    public const DELETE_USER = 'delete-user';
}
