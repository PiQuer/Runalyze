<?php

namespace Runalyze\Bundle\CoreBundle\Entity;
use Runalyze\Bundle\CoreBundle\Entity\ApiAuthorizedClient;

use Doctrine\ORM\EntityRepository;

class ApiAuthorizedClientsRepository extends EntityRepository
{

    public function save(ApiAuthorizedClient $apiAuthCode)
    {
        $this->_em->persist($apiAuthCode);
        $this->_em->flush();
    }

    public function remove(ApiAuthorizedClient $apiAuthCode)
    {
        $this->_em->remove($apiAuthCode);
        $this->_em->flush();
    }
}
