<?php

namespace Runalyze\Profile\Sport\Zones;

interface ZoneInterface
{
    /**
     * @return string
     */
    public function getUnit();

    /**
     * @return array
     */
    public function getDefaultSettings();

}
