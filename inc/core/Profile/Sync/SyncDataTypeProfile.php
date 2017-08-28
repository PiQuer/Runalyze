<?php
namespace Runalyze\Profile\Sync;
use Runalyze\Util\AbstractEnum;

class SyncDataTypeProfile extends AbstractEnum
{
    /** @var int */
    const ACTIVITIES = 1;

    /** @var int */
    const BODY_DATA = 2;

    /** @var int */
    const SLEEP_DATA = 3;

}