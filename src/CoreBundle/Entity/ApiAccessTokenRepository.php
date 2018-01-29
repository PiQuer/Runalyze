<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ApiAccessTokenRepository extends EntityRepository
{

    public function save(ApiAccessToken $apiAccessToken)
    {
        $this->_em->persist($apiAccessToken);
        $this->_em->flush();
    }

    public function remove(ApiAccessToken $apiAccessToken)
    {
        $this->_em->remove($apiAccessToken);
        $this->_em->flush();
    }
}
