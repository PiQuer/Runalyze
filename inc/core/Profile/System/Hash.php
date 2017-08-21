<?php

namespace Runalyze\Profile\System;

use Runalyze\Util\AbstractEnum;
use Runalyze\Util\InterfaceChoosable;

class Hash extends AbstractEnum
{
	/** @var int */
	const NONE = 0;

	/** @var int */
	const CHANGE_PASSWORD = 1;

	/** @var int */
	const ACTIVATION = 2;

    /** @var int */
    const DELETION = 2;

}
