<?php

namespace Runalyze\Profile\Sport;

use Runalyze\Common\Enum\AbstractEnum;
use Runalyze\Common\Enum\AbstractEnumFactoryTrait;
use Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Runalyze\Util\InterfaceChoosable;

class ZoneMetricProfile extends AbstractEnum implements InterfaceChoosable
{
    use AbstractEnumFactoryTrait;

    /** @var int */
    const PACE = 0;

    /** @var int */
    const POWER = 1;

    /** @var int */
    const HEARTRATE = 2;

    /**
     * @return array
     */
    public static function getChoices()
    {
        $choices = [];

        foreach (self::getEnum() as $enum) {
            $choices[self::get($enum)->getName()] = $enum;
        }

        return $choices;
    }
}
