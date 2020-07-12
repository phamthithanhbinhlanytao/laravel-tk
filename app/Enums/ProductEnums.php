<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static InStock()
 * @method static static OutOfStock()
 */
final class ProductEnums extends Enum implements LocalizedEnum
{
    const InStock = 1;
    const OutOfStock = 0;
}
