<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static User()
 * @method static static Admin()
 */
final class UserRoleEnums extends Enum
{
    const User = 1;
    const Admin = 0;
}
