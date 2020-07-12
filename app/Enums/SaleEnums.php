<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static HasSale()
 * @method static static DoesntHaveSale()
 */
final class SaleEnums extends Enum
{
    const HasSale = 1;
    const DoesntHaveSale = 0;
}
