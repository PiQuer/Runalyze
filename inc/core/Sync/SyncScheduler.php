<?php

namespace Runalyze\Sync;


use Runalyze\Bundle\CoreBundle\Entity\AccountClientSettings;
use Runalyze\Bundle\CoreBundle\Entity\AccountClientSettingsRepository;

class SyncScheduler
{
    /** @var AccountClientSettingsRepository */
    protected $AccountClientSettingsRepository;


    public function __construct(AccountClientSettingsRepository $repository)
    {
        $this->AccountClientSettingsRepository = $repository;
    }

}