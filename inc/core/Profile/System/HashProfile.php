<?php

namespace Runalyze\Profile\System;

use Runalyze\Common\Enum\AbstractEnum;

class HashProfile extends AbstractEnum
{
    /** @var int */
    const NONE = 0;

    /** @var int */
    const RECOVER_PASSWORD = 1;

    /** @var int */
    const ACTIVATION = 2;

    /** @var int */
    const DELETION = 2;
}
