<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ApiRefreshTokenRepository extends EntityRepository
{

    public function save(ApiRefreshToken $apiRefreshToken)
    {
        $this->_em->persist($apiRefreshToken);
        $this->_em->flush();
    }

    public function remove(ApiRefreshToken $apiRefreshToken)
    {
        $this->_em->remove($apiRefreshToken);
        $this->_em->flush();
    }
}
