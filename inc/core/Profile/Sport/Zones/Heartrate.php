<?php

namespace Runalyze\Profile\Sport\Zones;

use Runalyze\Bundle\CoreBundle\Form\Settings\Zones\HeartrateZoneType;
use Runalyze\Profile\Sport\Zones\ZoneInterface;

/**
 * @codeCoverageIgnore
 */
class Heartrate implements ZoneInterface
{

    public function getInternalName()
    {
        return 'heartrate';
    }

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

    /**
     * @return array
     */
    public function getFormType() {
        return HeartrateZoneType::class;
    }

}
