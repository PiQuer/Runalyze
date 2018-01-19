<?php

namespace Runalyze\Profile\Sport\Zones;

use Runalyze\Profile\Sport\Zones\ZoneInterface;

/**
 * @codeCoverageIgnore
 */
class Heartrate implements ZoneInterface
{

    public function getName()
    {
        return __('Heartrate');
    }

    public function getUnit()
    {
        return 'bpm';
    }

    public function getDefaultSettings()
    {
        return [];
    }

}
