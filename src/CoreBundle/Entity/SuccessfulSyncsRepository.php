<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Runalyze\Bundle\CoreBundle\Model\Sport\SportStatistics;
use Runalyze\Profile\Sport\Running;
use Runalyze\Profile\Sport\SportProfile;
use Runalyze\Util\LocalTime;

class SuccessfulSyncsRepository extends EntityRepository
{

    public function save(SuccessfulSyncs $successfulSyncs)
    {
        $this->_em->persist($successfulSyncs);
        $this->_em->flush();
    }

    public function remove(SuccessfulSyncs $successfulSyncs)
    {
        $this->_em->remove($successfulSyncs);
        $this->_em->flush();
    }
}
