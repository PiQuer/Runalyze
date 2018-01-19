<?php

namespace Runalyze\Profile\Sport\Zones;

interface ZoneInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getUnit();

    /**
     * @return array
     */
    public function getDefaultSettings();

    /**
     * @return array
     */
    public function getFormType();

}
