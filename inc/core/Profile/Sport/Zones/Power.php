<?php

namespace Runalyze\Profile\Sport\Zones;

use Runalyze\Profile\Sport\Zones\ZoneInterface;

/**
 * @codeCoverageIgnore
 */
class Power implements ZoneInterface
{
    public function getUnit()
    {
        return 'w';
    }

    public function getDefaultSettings()
    {
        return [];
    }

}
