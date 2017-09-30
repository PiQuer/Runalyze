<?php

namespace Runalyze\Profile\System;

use Runalyze\Common\Enum\AbstractEnum;

class AccountStatusProfile extends AbstractEnum
{
    /** @var int */
    const NOT_ACTIVATED = 0;

    /** @var int */
    const ACTIVATED = 1;

    /** @var int */
    const DISABLED = 2;
}
