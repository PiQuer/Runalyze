<?php
namespace Runalyze\Sync\Provider;
use Runalyze\Sync\Provider\ActivitySyncInterface;
use Runalyze\Profile\Sync\SyncProvider;

class TomTomMySports implements ActivitySyncInterface {

    public static function getIdentifier() {
        return SyncProvider::TOMTOM_MYSPORTS;
    }

    public function fetchActivityList() {
        //TODO
    }

    public function fetchActivity($identifier) {
        //TODO
    }
}