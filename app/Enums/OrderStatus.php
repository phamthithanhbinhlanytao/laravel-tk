<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Ordered = 1;
    const Approved = 2;
    const Received = 3;
    const Canceled = 4
    ;
}
