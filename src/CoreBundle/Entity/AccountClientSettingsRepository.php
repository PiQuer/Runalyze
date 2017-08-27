<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Runalyze\Bundle\CoreBundle\Model\Sport\SportStatistics;
use Runalyze\Profile\Sport\Running;
use Runalyze\Profile\Sport\SportProfile;
use Runalyze\Util\LocalTime;

class AccountClientSettingsRepository extends EntityRepository
{

    public function save(AccountClientSettings $accountClientSettings)
    {
        $this->_em->persist($accountClientSettings);
        $this->_em->flush();
    }

    public function remove(AccountClientSettings $accountClientSettings)
    {
        $this->_em->remove($accountClientSettings);
        $this->_em->flush();
    }
}
