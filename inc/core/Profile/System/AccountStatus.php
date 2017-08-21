<?php

namespace Runalyze\Profile\System;

use Runalyze\Util\AbstractEnum;
use Runalyze\Util\InterfaceChoosable;

class AccountStatus extends AbstractEnum
{
	/** @var int */
	const NOT_ACTIVATED = 0;

	/** @var int */
	const ACTIVATED = 1;

	/** @var int */
	const DISABLED = 2;

}
