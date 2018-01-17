<?php

namespace Runalyze\Profile\Sport\Zones;

use Runalyze\Profile\Sport\Zones\ZoneInterface;

/**
 * @codeCoverageIgnore
 */
class Pace implements ZoneInterface
{
    //TODO Depends on sport type, so stored values should be in s
    public function getUnit()
    {
        return 's';
    }

    public function getDefaultSettings()
    {
        return [];
    }

}
