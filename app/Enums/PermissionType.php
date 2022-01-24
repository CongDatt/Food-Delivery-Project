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

    public const VIEW_MERCHANT = 'view-merchant';

    public const CREATE_MERCHANT = 'create-merchant';

    public const UPDATE_MERCHANT = 'update-merchant';

    public const DELETE_MERCHANT = 'delete-merchant';


    public const VIEW_SHIPPER = 'view-shipper';

    public const CREATE_SHIPPER = 'create-shipper';

    public const UPDATE_SHIPPER = 'update-shipper';

    public const DELETE_SHIPPER = 'delete-shipper';

    public const VIEW_DISH = 'view-dish';

    public const CREATE_DISH = 'create-dish';

    public const UPDATE_DISH = 'update-dish';

    public const DELETE_DISH = 'delete-dish';

    public const VIEW_MENU = 'view-menu';

    public const CREATE_MENU = 'create-menu';

    public const UPDATE_MENU = 'update-menu';

    public const DELETE_MENU = 'delete-menu';
}
